<?php
/**
 * Created by Diego
 * Date: 22-12-14
 * Time: 03:25 PM
 */

namespace models;


use DateTime;

class Client
{
    public $Id;
    public $Gmail;
    public $Status;
    public $InsertDate;
    public $UpdateDate;

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

    //region Getters y Setters

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
     * @param string $Gmail
     * @return $this
     */
    public function setGmail($Gmail)
    {
        $this->Gmail = $Gmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getGmail()
    {
        return $this->Gmail;
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