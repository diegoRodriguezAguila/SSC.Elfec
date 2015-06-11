<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 1/7/15
 * Time: 4:13 PM
 */

namespace models\web_services;


class WSResponse {
    private $Response;
    private $Errors;

    function __construct()
    {
        $this->Errors = array();
    }
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * @param $errors
     */
    public function setErrors($errors)
    {
        $this->Errors = $errors;
    }

    /**
     * @param $error
     */
    public function addError($error)
    {
        array_push($this->Errors,$error);
    }
    public function mySelf()
    {
        return $this;
    }
    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->Errors;
    }

    /**
     * @param mixed $Response
     */
    public function setResponse($Response)
    {
        $this->Response = $Response;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->Response;
    }

} 