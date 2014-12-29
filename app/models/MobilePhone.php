<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 12/24/14
 * Time: 5:25 PM
 */

namespace models;


use DateTime;

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
     * @param int $ClientId
     * @return $this
     */
    public function setClientId($ClientId)
    {
        $this->ClientId = $ClientId;
        return $this;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->ClientId;
    }

    /**
     * @param int $Id
     * @return $this
     */
    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param DateTime $InsertDate
     * @return $this
     */
    public function setInsertDate($InsertDate)
    {
        $this->InsertDate = $InsertDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getInsertDate()
    {
        return $this->InsertDate;
    }

    /**
     * @param string $Number
     * @return $this
     */
    public function setNumber($Number)
    {
        $this->Number = $Number;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->Number;
    }

    /**
     * @param int $Status
     * @return $this
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param DateTime $UpdateDate
     * @return $this
     */
    public function setUpdateDate($UpdateDate)
    {
        $this->UpdateDate = $UpdateDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdateDate()
    {
        return $this->UpdateDate;
    }

} 