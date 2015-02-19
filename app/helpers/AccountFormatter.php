<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 13-02-15
 * Time: 10:25 AM
 */

namespace helpers;

/**
 * Class AccountFormatter Formatea el numero de cuenta
 * @package helpers
 */
class AccountFormatter {

    /**
     * Formatea la cadena de numero de cuenta con los guiones y tamaño 10 respectivos
     * @param string $accountNumber
     */
    public static function format($accountNumber)
    {
        if(strlen($accountNumber)==9)
            $accountNumber = "0".$accountNumber;
        $accountNumber = self::insertStr($accountNumber,2, "-");
        $accountNumber = self::insertStr($accountNumber,6, "-");
        $accountNumber = self::insertStr($accountNumber,10, "-");
        return $accountNumber;
    }

    /**
     * Inserta una cadena en la posición especificada
     * @param string $oldstr
     * @param int $pos
     * @param string $str_to_insert
     * @return string
     */
    public static function insertStr($oldstr, $pos, $str_to_insert)
    {
       return substr($oldstr, 0, $pos) . $str_to_insert . substr($oldstr, $pos);
    }
} 