<?php
/**
 * Created by Zuki
 * Date: 26-12-14
 * Time: 02:50 PM
 */

namespace data_access;

/**
 * Provee de un metodo para obtener una instancia de IDeviceDAL con la configuración de acceso
 * a base de datos determinado en config.php
 * Class DeviceDALFactory
 * @package data_access
 */
class DeviceDALFactory {

    private static $Instance;

    /**
     * @return IDeviceDAL
     */
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\DeviceDAL';
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }
}