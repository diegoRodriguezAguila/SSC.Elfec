<?php
/**
 * Created by Zuki
 * Date: 1/2/15
 * Time: 11:36 AM
 */
namespace data_access;
class LocationPointDALFactory {
    private static $Instance;
    public static function instance()
    {
        if(!isset(self::$Instance))
        {
            $classString = 'data_access\\'.DB_TYPE.'\\LocationPointDAL';
            self::$Instance =  new $classString();
        }
        return self::$Instance;
    }
} 