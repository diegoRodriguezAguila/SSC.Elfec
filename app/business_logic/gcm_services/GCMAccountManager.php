<?php
/**
 * Created by Diego
 * Date: 28-01-15
 * Time: 08:36 AM
 */

namespace business_logic\gcm_services;

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
    public static function propagateNewAccountToDevices($ownerClientGmail, $newAccount, $originDeviceImei)
    {

    }
} 