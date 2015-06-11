<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 09-06-15
 * Time: 04:57 PM
 */

namespace data_access;

/**
 * Class AppDALFactory
 * Provee de un metodo para obtener una instancia de IAppDAL con la configuración de acceso
 * a base de datos determinado en config.php
 * @package data_access
 */
class AppDALFactory {
    private static $Instance;

    /**
     * @return IAppDAL
     */
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\AppDAL';
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }
} 