<?php
/**
 * Created by Diego
 * Date: 28-01-15
 * Time: 08:36 AM
 */

namespace business_logic\gcm_services;
use data_access\ClientDALFactory;
use helpers\AccountFormatter;
use helpers\GCMSender;
use models\Account;
use models\enums\NotificationKey;
use models\enums\NotificationType;

/**
 * Class GCMAccountManager provee de metodos necesarios para distintos tipos de envios
 * de cuentas a travez de GCM
 * @package business_logic\gcm_services
 */
class GCMAccountManager {

    /**
     * Envía la nueva cuenta a todos los dispositivos del usuario, excepto al que hizo el registro
     * @param string $ownerClientGmail
     * @param Account $newAccount
     * @param string $originDeviceImei
     */
    public static function propagateNewAccountToDevices($ownerClientGmail,Account $newAccount, $originDeviceImei)
    {
        $clientDAL = ClientDALFactory::instance();
        $devices=$clientDAL->getClientDevices( $clientDAL->GetClientId($ownerClientGmail));
        $msg = array
        (
            'message'       => 'Se registró la cuenta: '.
                AccountFormatter::format($newAccount->getAccountNumber())
                .', con el NUS: '.$newAccount->getNUS(),
            'title'         => 'Nueva cuenta',
            'key'           => NotificationKey::NEW_ACCOUNT,
            'type'          => NotificationType::ACCOUNT,
            'account'       => $newAccount->jsonSerialize(),
            'gmail'         => $ownerClientGmail
        );
        $d=array();
        foreach($devices as $dev)
        {
            if($dev->imei!=$originDeviceImei)
                array_push($d,$dev->gcm_token);
        }
        GCMSender::sendDataToDevices($d,$msg);
    }

    /**
     * Propaga la eliminación de una cuenta a todos los dispositivos pertinentes, excepto al que realizó la acción
     * @param string $ownerClientGmail
     * @param string $NUS
     * @param string $originDeviceImei
     */
    public static function propagateDeletedAccountToDevices($ownerClientGmail, $NUS, $originDeviceImei)
    {
        $clientDAL = ClientDALFactory::instance();
        $devices=$clientDAL->getClientDevices( $clientDAL->GetClientId($ownerClientGmail));
        $msg = array(
            'message'       => 'Se eliminó la cuenta con el NUS: '.$NUS,
            'title'         => 'Cuenta eliminada',
            'key'           => NotificationKey::ACCOUNT_DELETED,
            'type'          =>  NotificationType::ACCOUNT,
            'nus'           => $NUS,
            'gmail'         => $ownerClientGmail
        );
        $d=array();
        foreach($devices as $dev)
        {
            if($dev->imei!=$originDeviceImei)
                array_push($d,$dev->gcm_token);
        }
        GCMSender::sendDataToDevices($d,$msg);
    }
} 