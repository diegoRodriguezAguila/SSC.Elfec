<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 12/24/14
 * Time: 5:25 PM
 */

namespace models;


class MobilePhone {
    public $Id;
    public $ClientId;
    public $Number;
    public $Status;
    public $InsertDate;
    public $UpdateDate;
    public static function create() {
        $instance = new self();
        return $instance;
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
     * @param mixed $Number
     */
    public function setNumber($Number)
    {
        $this->Number = $Number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->Number;
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