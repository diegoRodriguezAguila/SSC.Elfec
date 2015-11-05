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
use models\enums\DataBaseType;
use models\enums\OutageType;
use external_data_access\oracle\AccountEDAL;

/**
 * Clase que se encarga de el envío y gestión de notificaciones
 * Class NotificationManager
 * @package business_logic
 */
class NotificationManager
{
    const NON_PAYMENT_MESSAGE = 'Estimado cliente, el suministro de Energía Eléctrica con NUS <b>%s</b> ubicado en %s tiene facturas pendientes de pago del: %s, por lo que se encuentra en proceso de CORTE DEL SERVICIO. Agradecemos pase a cancelar su deuda al punto de cobranza más cercano.';
    const OUTAGE_MESSAGE = '%s.<br/>Cuenta afectada con NUS: <b>%s</b> y dirección: %s.<br/>Desde el: %s %s';

    const EXPIRED_DEBT_MESSAGE = 'Estimado cliente, hoy vence el plazo para pagar su factura de consumo de Energía Eléctrica del suministro con NUS <b>%s</b> ubicado en %s correspondiente al mes de <b>%s</b>';

    /**
     * Realiza el envío de las notificaciones a aquellos clientes que tengan 2 o más facturas
     * que esten vencidas el día de hoy, avisandoles sobre el posible corte de suministro
     * @return integer número de mensajes enviados
     */
    public static function processNonPaymentOutageNotificationSend()
    {
        $nonpayment_accounts = AccountManager::getNonPaymentOutageAccounts();
        $notificationDAL = NotificationDALFactory::instance();
        $notificationId = $notificationDAL->registerNotificationMessage(self::NON_PAYMENT_MESSAGE, -1, OutageType::NON_PAYMENT, DataBaseType::$PGSQL_DATABASE);
        foreach ($nonpayment_accounts as $account) {
            $notificationDAL->registerNotificationDetail($notificationId, $account->nus, DataBaseType::$PGSQL_DATABASE);
            GCMOutageManager::sendNonPaymentOutageNotification($account,
                self::prepareNonPaymentOutageMessage($account->nus));
        }
        return count($nonpayment_accounts);
    }

    /**
     * Prepara el mensaje que se enviará al usuario en caso de corte por falta de pago
     * @param $nus
     * @return string
     */
    private static function prepareNonPaymentOutageMessage($nus)
    {
        $fullAccountInfo = AccountManager::getFullAccountData($nus);
        return sprintf(self::NON_PAYMENT_MESSAGE, $nus, mb_convert_case($fullAccountInfo->getAddress(), MB_CASE_TITLE, "UTF-8"),
            AccountEDAL::getPeriodsOfAllExpiredDebts($nus));
    }

    /**
     * Realiza el envío de las notificaciones a aquellos clientes que tengan facturas
     * que esten vencidas el día de hoy
     * @return integer número de mensajes enviados
     */
    public static function processExpiredDebtNotificationSend()
    {
        $expired_debt_accounts = AccountManager::getTodayExpiredDebtAccounts();
        $notificationDAL = NotificationDALFactory::instance();
        $notificationId = $notificationDAL->registerNotificationMessage(self::EXPIRED_DEBT_MESSAGE, -1, OutageType::EXPIRED_DEBT, DataBaseType::$PGSQL_DATABASE);
        foreach ($expired_debt_accounts as $account) {
            $notificationDAL->registerNotificationDetail($notificationId, $account->nus, DataBaseType::$PGSQL_DATABASE);
            GCMOutageManager::sendExpiredDebtNotification($account,
                self::prepareExpiredDebtMessage($account->nus));
        }
        return count($expired_debt_accounts);
    }

    /**
     * Prepara el mensaje que se enviará al usuario en caso de corte por falta de pago
     * @param $nus
     * @return string
     */
    private static function prepareExpiredDebtMessage($nus)
    {
        $fullAccountInfo = AccountManager::getFullAccountData($nus);
        return sprintf(self::EXPIRED_DEBT_MESSAGE, $nus, mb_convert_case($fullAccountInfo->getAddress(), MB_CASE_TITLE, "UTF-8"),
            AccountEDAL::getJustExpiredDebtPeriod($nus));
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
        if ($outageCase != null) {
            $affectedAccounts = OutageCasesManager::getOutageCaseAccounts($outageCaseNumber);
            $notificationDAL = NotificationDALFactory::instance();
            $notificationId = $notificationDAL->registerNotificationMessage($message, $outageCaseNumber,
                self::convertOutageTypeToInt($outageCase->tipo_corte), SessionManager::getUserDataBaseConnection());
            foreach ($affectedAccounts as $account) {
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
        $fullAccountInfo = AccountManager::getFullAccountData($nus);
        return sprintf(self::OUTAGE_MESSAGE, $message, $nus, mb_convert_case($fullAccountInfo->getAddress(), MB_CASE_TITLE, "UTF-8"),
            (new \DateTime($startDate))->format('d/m/Y H:i'),
            (($endDate != null) ?
                (" hasta el: " . (new \DateTime($endDate))->format('d/m/Y H:i')) : ""));
    }

    /**
     * Convierte el tipo de corte definido en centrality por la key de notificación del sistema correspondiente
     * @param $outageType
     * @return string
     */
    private static function convertOutageTypeToNotificationKey($outageType)
    {
        switch ($outageType) {
            case "Programado":
            {
                return NotificationKey::SCHEDULED_OUTAGE;
            }
            case "No programado":
            {
                return NotificationKey::INCIDENTAL_OUTAGE;
            }
            default:
                {
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
        switch ($outageType) {
            case "Programado":
            {
                return OutageType::SCHEDULED;
            }
            case "No programado":
            {
                return OutageType::INCIDENTAL;
            }
            default:
                {
                return OutageType::UNDEFINED;
                }
        }
    }
} 