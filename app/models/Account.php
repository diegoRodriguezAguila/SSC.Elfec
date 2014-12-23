<?php
/**
 * Created by Diego
 * Date: 22-12-14
 * Time: 03:06 PM
 */

namespace models;
use DateTime;

/**
 * Modelo para una cuenta
 * Class Account
 * @package models
 */
class Account
{
    private $Id;
    private $UserId;
    private $AccountNumber;
    private $NUS;
    private $Status;
    private $InsertDate;
    private $UpdateDate;

    public function __construct()
    {
    }

    /**
     * Static constructor / factory
     */
    public static function create() {
        $instance = new self();
        return $instance;
    }


    //region  Getters y Setters
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
     * @param int $UserId
     * @return $this
     */
    public function setUserId($UserId)
    {
        $this->UserId = $UserId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->UserId;
    }

    /**
     * @param int $AccountNumber
     * @return $this
     */
    public function setAccountNumber($AccountNumber)
    {
        $this->AccountNumber = $AccountNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccountNumber()
    {
        return $this->AccountNumber;
    }

    /**
     * @param int $NUS
     * @return $this
     */
    public function setNUS($NUS)
    {
        $this->NUS = $NUS;
        return $this;
    }

    /**
     * @return int
     */
    public function getNUS()
    {
        return $this->NUS;
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
    //endregion

} 