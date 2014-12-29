<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 22-12-14
 * Time: 03:27 PM
 */

namespace models;

use DateTime;
class Device
{
    public $Id;
    public $ClientId;
    public $GCMToken;
    public $Status;
    public $Brand;
    public  $Model;
    public $InsertDate;
    public $UpdateDate;
    public $Imei;
    public function __construct()
    {
    }
    public static function create() {
        $instance = new self();

        return $instance;
    }

    /**
     * @param mixed $Model
     */
    public function setModel($Model)
    {
        $this->Model = $Model;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->Model;
    }

    /**
     * @param mixed $Brand
     */
    public function setBrand($Brand)
    {
        $this->Brand = $Brand;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->Brand;
    }
    /**
     * @param mixed $ClientId
     */
    public function setClientId($ClientId)
    {
        $this->ClientId = $ClientId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->ClientId;
    }

    /**
     * @param mixed $GCMToken
     */
    public function setGCMToken($GCMToken)
    {
        $this->GCMToken = $GCMToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGCMToken()
    {
        return $this->GCMToken;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Imei
     */
    public function setImei($Imei)
    {
        $this->Imei = $Imei;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImei()
    {
        return $this->Imei;
    }

    /**
     * @param mixed $InsertDate
     */
    public function setInsertDate($InsertDate)
    {
        $this->InsertDate = $InsertDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInsertDate()
    {
        return $this->InsertDate;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param mixed $UpdateDate
     */
    public function setUpdateDate($UpdateDate)
    {
        $this->UpdateDate = $UpdateDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->UpdateDate;
    }
} 