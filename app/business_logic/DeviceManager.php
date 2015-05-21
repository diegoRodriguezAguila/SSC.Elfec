<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 21-05-15
 * Time: 09:38 AM
 */

namespace business_logic;
use data_access\DeviceDALFactory;

/**
 * Class DeviceManager
 * Se encarga de la capa de lógica de negocio de dispositivos
 * @package business_logic
 */
class DeviceManager {
    /**
     * Actualiza el nuevo toquen a todos los dispositivos con el token anterior e IMEI correspondientes
     * @param string $lastToken
     * @param string $IMEI
     * @param string $newToken
     * @return bool
     */
    public static function updateDeviceGCMToken($lastToken, $IMEI, $newToken)
    {
        if(self::deviceExists($lastToken, $IMEI))
        {
            DeviceDALFactory::instance()->updateDevicesGCMToken($lastToken, $IMEI, $newToken);
            return true;
        }
        return false;
    }

    /**
     * Verifica si es que existe al menos un dispositivo con la combinación
     * token imei provista
     * @param string $GCMToken
     * @param string $IMEI
     * @return boolean
     */
    public static function deviceExists($GCMToken, $IMEI)
    {
        return count(DeviceDALFactory::instance()->findByTokenAndIMEI($GCMToken, $IMEI))>0;
    }
} 