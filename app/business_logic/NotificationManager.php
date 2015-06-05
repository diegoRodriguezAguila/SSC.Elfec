<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 02-06-15
 * Time: 10:31 AM
 */

namespace business_logic;
use business_logic\gcm_services\GCMOutageManager;
use business_logic\SessionManager;
use data_access\NotificationDALFactory;
use models\enums\NotificationKey;

/**
 * Clase que se encarga de el envío y gestión de notificaciones
 * Class NotificationManager
 * @package business_logic
 */
class NotificationManager {

    const NON_PAYMENT_MESSAGE ='Estimado cliente, se le informa que la cuenta con NUS: <b>%s</b> es pasible a corte a partir de la fecha de mañana: <b>%s</b>. Le recomendamos pagar todas sus deudas pendientes, para evitar quedarse sin suministro de energía.';

    /**
     * Realiza el envío de las notificaciones a aquellos clientes que tengan facturas
     * que esten vencidas el día de hoy
     */
    public static function processNonPaymentOutageNotificationSend()
    {
        $nonpayment_accounts= AccountManager::getNonPaymentOutageAccounts();
        $notificationDAL = NotificationDALFactory::instance();
        $notificationId = $notificationDAL->registerNotificationMessage("Corte por mora", 0, 2, SessionManager::getUserDataBaseConnection());
        foreach($nonpayment_accounts as $account)
        {
            $notificationDAL->registerNotificationDetail($notificationId, $account->nus, SessionManager::getUserDataBaseConnection());
            GCMOutageManager::sendNonPaymentOutageNotification($account,
                self::prepareNonPaymentOutageMessage($account->nus));
        }
    }

    /**
     * Prepara el mensaje que se enviará al usuario en caso de corte por falta de pago
     * @param $nus
     * @return string
     */
    private static function prepareNonPaymentOutageMessage($nus)
    {
        return sprintf(self::NON_PAYMENT_MESSAGE, $nus, (new \DateTime('tomorrow'))->format('d/m/Y'));
    }

    /**
     * Realiza las validaciones y el envío de las notificaciones de cortes
     * relacionadas a un caso
     * @param $message
     * @param $outageCaseNumber
     * @return bool
     */
    public static function processOutageNotificationSend($message, $outageCaseNumber)
    {
        $outageCase = OutageCasesManager::getOutageCase($outageCaseNumber);
        if($outageCase!=null)
        {
            $affectedAccounts = OutageCasesManager::getOutageCaseAccounts($outageCaseNumber);
            $notificationDAL = NotificationDALFactory::instance();
            $notificationId = $notificationDAL->registerNotificationMessage($message, $outageCaseNumber,
                self::convertOutageTypeToInt($outageCase->tipo_corte), SessionManager::getUserDataBaseConnection());
            foreach($affectedAccounts as $account)
            {
                 GCMOutageManager::sendOutageNotification($account,
                     self::prepareOutageMessage($account->nus, $message,
                         $outageCase->fecha_inicio, $outageCase->fecha_fin),
                     self::convertOutageTypeToNotificationKey($outageCase->tipo_corte));
                $notificationDAL->registerNotificationDetail($notificationId, $account->nus, SessionManager::getUserDataBaseConnection());
            }
            return true;
        }
        return false;
    }

    /**
     * Prepara el mensaje que se enviará al usuario en caso de un corte de suministro
     * @param $nus
     * @param $message
     * @param $startDate
     * @param $endDate
     * @return string
     */
    private static function prepareOutageMessage($nus, $message, $startDate, $endDate)
    {
        return "$message.<br/>Cuenta afectada: <b>$nus</b>.<br/>Desde el: "
        .(new \DateTime($startDate))->format('d/m/Y H:i').(($endDate!=null)?
            (" hasta el: ".(new \DateTime($endDate))->format('d/m/Y H:i')):"");
    }

    /**
     * Convierte el tipo de corte definido en centrality por la key de notificación del sistema correspondiente
     * @param $outageType
     * @return string
     */
    private static function convertOutageTypeToNotificationKey($outageType)
    {
        switch($outageType){
            case "Programado":{
                return NotificationKey::SCHEDULED_OUTAGE;
            }
            case "No programado":{
                return NotificationKey::INCIDENTAL_OUTAGE;
            }
            default:{
                return null;
            }
        }
    }

    /**
     * Convierte el tipo de corte por su entero equivalente
     * @param $outageType
     * @return string
     */
    private static function convertOutageTypeToInt($outageType)
    {
        switch($outageType){
            case "Programado":{
                return 0;
            }
            case "No programado":{
                return 1;
            }
            default:{
                return -1;
            }
        }
    }
} 