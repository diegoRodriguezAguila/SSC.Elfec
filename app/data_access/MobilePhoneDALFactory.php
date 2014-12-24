<?php
/**
 * Created by Zuki
 * Date: 12/24/14
 * Time: 5:22 PM
 */

namespace data_access;

class MobilePhoneDALFactory {

    private static $Instance;
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\MobilePhoneDAL';
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }
} 