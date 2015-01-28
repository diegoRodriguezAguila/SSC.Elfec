<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 28-01-15
 * Time: 10:22 AM
 */

namespace data_access;

/**
* Provee de un metodo para obtener una instancia de IContactDAL con la configuración de acceso
* a base de datos determinado en config.php
* Class AccountDALFactory
 * @package data_access
*/
class ContactDALFactory {
    private static $Instance;

    /**
     * Instancia un IContactDAL con la instancia de base de datos configurada
     * @return IContactDAL
     */
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\ContactDAL';
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }
} 