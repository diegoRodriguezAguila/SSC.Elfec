<?php
/**
 * Created by Diego
 * Date: 22-12-14
 * Time: 03:06 PM
 */

namespace models;


class Account
{
    private $Id;
    private $UserId;
    private $AccountNumber;
    private $NUS;
    private $Status;
    private $InsertDate;
    private $UpdateDate;


    //region  Getters y Setters
    /**
     * @param mixed $AccountNumber
     */
    public function setAccountNumber($AccountNumber)
    {
        $this->AccountNumber = $AccountNumber;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->AccountNumber;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
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
    }

    /**
     * @return mixed
     */
    public function getInsertDate()
    {
        return $this->InsertDate;
    }

    /**
     * @param mixed $NUS
     */
    public function setNUS($NUS)
    {
        $this->NUS = $NUS;
    }

    /**
     * @return mixed
     */
    public function getNUS()
    {
        return $this->NUS;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
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
    }

    /**
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->UpdateDate;
    }

    /**
     * @param mixed $UserId
     */
    public function setUserId($UserId)
    {
        $this->UserId = $UserId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->UserId;
    }
    //endregion

} 