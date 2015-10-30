<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 09-06-15
 * Time: 04:14 PM
 */

namespace business_logic;

use data_access\AppDALFactory,
    models\web_services\WSToken;


class TokenManager
{

    /**
     * Verifica la validéz de un token
     * @param $wsToken WSToken
     * @return bool
     */
    public static function isWSTokenValid($wsToken)
    {
        $appDAL = AppDALFactory::instance();
        $appInfos = $appDAL->getAllValidAppInfos();
        foreach ($appInfos as $appInfo) {
            if($wsToken->getToken() == self::generateToken($wsToken->getImei(), $appInfo->signature_hash,
                    $appInfo->salt, $appInfo->version_code)->getToken())
                return true;
        }
        return false;
    }

    /**
     * Genera un token con el o los parámetros provistos. Si se provee solo el IMEI
     * se genera a partir de los datos en la db
     * @param $deviceIMEI string
     * @param null $signature string
     * @param null $salt string
     * @param null $versionCode integer
     * @return WSToken
     */
    public static function generateToken($deviceIMEI, $signature = null,
                                         $salt = null, $versionCode = null)
    {
        if ($signature == null || $salt == null || $versionCode == null) {
            $appDAL = AppDALFactory::instance();
            $appInfo = $appDAL->getLastAppInfo();
            $signature = $signature == null ? $appInfo->signature_hash : $signature;
            $salt = $salt == null ? $appInfo->salt : $salt;
            $versionCode = $versionCode == null ? $appInfo->version_code : $versionCode;
        }
        return self::_generateToken($deviceIMEI, $signature, $salt, $versionCode);
    }

    /**
     * Genera un token con los parámetros provistos
     * @param $deviceIMEI string
     * @param $signature string
     * @param $salt string
     * @param $versionCode integer
     * @return WSToken
     */
    private static function _generateToken($deviceIMEI, $signature,
                                           $salt, $versionCode)
    {
        $key = hash('sha512', self::mergeBetween($deviceIMEI, $signature), true);
        $message = self::mergeBetween(self::prepareMessage($salt, $versionCode), substr($key, 32, 32));
        $pos = (floor(strlen($deviceIMEI) / 2));
        $ivSelector = $deviceIMEI[(integer)$pos];
        $subKey = $versionCode % 2 != 0 ? substr($key, 0, 16) : substr($key, 16, 16);
        $iv = $ivSelector % 2 != 0 ? substr($key, 0, 16) : substr($key, 16, 16);
        $token = openssl_encrypt($message, 'AES-256-CBC', $subKey, 0, $iv);
        return new WSToken($deviceIMEI, $token);
    }

    /**
     * Prepara un mensaje a partir de un salt y version de codigo
     * @param $salt
     * @param $versionCode
     * @return string
     */
    private static function prepareMessage($salt, $versionCode)
    {
        $hex = dechex($versionCode);
        $length = strlen($hex);
        for ($i = 0; $i < $length; $i++) {
            $pos = hexdec($salt[$i]);
            $salt = substr_replace($salt, $hex[$i], $pos, 0);
        }
        return $salt;
    }

    /**
     * Merges two strings in a way that a pattern like ABABAB will be
     * the result.
     *
     * @param     string $str1 String A
     * @param     string $str2 String B
     * @return    string    Merged string
     */
    private static function mergeBetween($str1, $str2)
    {

        // Split both strings
        $str1 = str_split($str1, 1);
        $str2 = str_split($str2, 1);

        // Swap variables if string 1 is larger than string 2
        if (count($str1) >= count($str2))
            list($str1, $str2) = array($str2, $str1);

        // Append the shorter string to the longer string
        for ($x = 0; $x < count($str1); $x++)
            $str2[$x] .= $str1[$x];

        return implode('', $str2);
    }

    /**
     * Verifica si los credenciales provistos coinciden con los credenciales
     * de la aplicación definidos
     * @param $signature string
     * @param $salt string
     * @param $versionCode integer
     * @return bool
     */
    public static function areCredentialsValid($signature, $salt, $versionCode)
    {
        $appDAL = AppDALFactory::instance();
        $appInfos = $appDAL->getAllValidAppInfos();
        foreach ($appInfos as $appInfo) {
            if($appInfo->signature_hash == $signature && $appInfo->salt == $salt && $appInfo->version_code == $versionCode)
                return true;
        }
        return false;
    }
} 