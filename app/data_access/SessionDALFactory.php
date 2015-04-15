<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 3/10/15
 * Time: 9:30 PM
 */

namespace data_access;


class SessionDALFactory {
    private static $Instance;

    /**
     * @return ISessionDAL
     */
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\SessionDAL';
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }
} 