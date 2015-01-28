<?php
/**
 * Created by Diego
 * Date: 28-01-15
 * Time: 08:36 AM
 */

namespace business_logic\gcm_services;
use data_access\ClientDALFactory;
use data_access\pgsql\ClientDAL;
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
     * @param $ownerClientGmail
     * @param $newAccount
     * @param $originDeviceImei
     */
    public static function propagateNewAccountToDevices($ownerClientGmail,Account $newAccount, $originDeviceImei)
    {
        $clientDAL = ClientDALFactory::instance();
        $devices=$clientDAL->getMyDevices( $clientDAL->GetClientId($ownerClientGmail));
        $msg = array
        (
            'message'       => 'Se añadio una nueva cuenta',
            'title'         => 'Nueva cuenta',
            'key'           => 'NewAccount',
            'nus'           => $newAccount->getNUS(),
            'number'        => $newAccount->getAccountNumber(),
            'gmail'         => $ownerClientGmail
        );
        $d=array();
        foreach($devices as $valor)
            array_push($d,$valor->gcm_token);
        GCMSender::sendDataToDevices($d,$msg);

    }
} 