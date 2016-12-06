<?php
namespace business_logic;
use models\web_services\WSToken;

/**
 * Se encarga de la seguridad de los ws
 * Class WSSecurity
 * @package business_logic
 */
class WSSecurity
{
    /**
     * Verifica la autenticidad de la solicitud por medio del header de token
     */
    public static function verifyAuthenticity()
    {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')? 'HTTPS' : 'HTTP';
        $tokenName = ($protocol . '_X_WS_TOKEN');
        if (!isset($_SERVER[$tokenName]))
            die(http_response_code(403));
        $wsToken = json_decode($_SERVER[$tokenName]);
        if($wsToken==null)
           die(http_response_code(400));
        if(!isset($wsToken->imei) || !isset($wsToken->token) ||
            $wsToken->imei==null  || $wsToken->token==null)
            die(http_response_code(403));
        if(!TokenManager::isWSTokenValid(new WSToken($wsToken->imei, $wsToken->token)))
            die(http_response_code(403));
    }
}