<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 11:00 AM
 */

namespace data_access;

/**
 * Provee de un metodo para obtener una instancia de IAccountDAL con la configuración de acceso
 * a base de datos determinado en config.php
 * Class AccountDALFactory
 * @package data_access
 */
class AccountDALFactory {
    private static $Instance;

    /**
     * @return IAccountDAL
     */
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\AccountDAL';
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }
} 