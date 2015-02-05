<?php
/**
 * Created by Diego
 * Date: 28-01-15
 * Time: 08:36 AM
 */

namespace business_logic\gcm_services;
use data_access\ClientDALFactory;
use helpers\GCMSender;
use models\Account;

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
            'message'       => 'Se registró la cuenta: '.$newAccount->getAccountNumber().', con el nus: '.$newAccount->getNUS(),
            'title'         => 'Nueva cuenta',
            'key'           => 'NewAccount',
            'type'          => 1,
            'nus'           => $newAccount->getNUS(),
            'number'        => $newAccount->getAccountNumber(),
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
        $msg = array
        (
            'message'       => 'Se eliminó la cuenta con el nus '.$NUS,
            'title'         => 'Cuenta eliminada',
            'key'           => 'AccountDeleted',
            'type'          =>  1,
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