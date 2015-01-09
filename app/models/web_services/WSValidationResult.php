<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 1/9/15
 * Time: 10:59 AM
 */

namespace models\web_services;


class WSValidationResult {
    public $key;
    public $message;

    function __construct($key, $message)
    {
        $this->key = $key;
        $this->message = $message;
    }

    /**
     * @param mixed $Key
     */
    public function setKey($Key)
    {
        $this->key = $Key;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $Message
     */
    public function setMessage($Message)
    {
        $this->message = $Message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

} 