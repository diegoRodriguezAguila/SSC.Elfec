<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 02-06-15
 * Time: 03:02 PM
 */

namespace data_access;

/**
 * Provee de un metodo para obtener una instancia de INotificationDAL con la configuración de acceso
 * a base de datos determinado en config.php
 * Class NotificationDALFactory
 * @package data_access
 */
class NotificationDALFactory {

    private static $Instance;
    /**
     * @return INotificationDAL
     */
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\NotificationDAL';
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }
} 