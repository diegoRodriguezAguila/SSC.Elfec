<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 09-06-15
 * Time: 04:15 PM
 */

namespace models\web_services;

/**
 * Class WSToken
 * Es la clase que contiene el token que permite llamar a los WS
 * @package models\web_services
 */
class WSToken
{
    private $imei;
    private $token;

    public function __construct($imei, $token)
    {
        $this->imei = $imei;
        $this->token = $token;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    public function  getImei()
    {
        return $this->imei;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function __toString()
    {
        return json_encode($this);
    }
} 