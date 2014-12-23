<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 23-12-14
 * Time: 02:28 PM
 */

namespace data_access;

 class AbstractFactory {

    protected static $Name;
    protected static $Instance;

    /**
     * Instancia una clase de tipo de una interfaz de acceso a datos con la configuración de acceso a base de datos
     * @return mixed
     */
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\'.self::$Name;
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }

} 