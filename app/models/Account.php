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
    private $ClientId;
    private $AccountNumber;
    private $NUS;
    private $AccountOwner;
    private $Address;
    /**
     * Deudas de la cuenta
     * @var array
     */
    public $Debts = [];
    private $EnergySupplyStatus;
    private $Status;
    private $InsertDate;
    private $UpdateDate;

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        $debtsArrayJson = [];
        foreach($this->Debts as $debt)
        {
            array_push($debtsArrayJson, $debt->jsonSerialize());
        }
        $vars["Debts"] = $debtsArrayJson;
        return $vars;
    }

    private function __construct()
    {
    }

    /**
     * Static constructor / factory
     */
    public static function create() {
        return new self();
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
    public function setClientId($UserId)
    {
        $this->ClientId = $UserId;
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
     * @param int $EnergySupplyStatus
     * @return $this
     */
    public function setEnergySupplyStatus($EnergySupplyStatus)
    {
        $this->EnergySupplyStatus = $EnergySupplyStatus;
        return $this;
    }

    /**
     * @return int
     */
    public function getEnergySupplyStatus()
    {
        return $this->EnergySupplyStatus;
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
     * @param string $AccountOwner
     * @return $this
     */
    public function setAccountOwner($AccountOwner)
    {
        $this->AccountOwner = $AccountOwner;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountOwner()
    {
        return $this->AccountOwner;
    }

    /**
     * @param string $Address
     * @return $this
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->Address;
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