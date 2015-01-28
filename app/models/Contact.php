<?php
/**
 * Created by Diego
 * Date: 28-01-15
 * Time: 10:24 AM
 */

namespace models;

use DateTime;

class Contact {

    public $Id;
    public $Phone;
    public $Address;
    public $Email;
    public $WebPage;
    public $Facebook;
    public $FacebookId;
    public $Status;
    public $InsertDate;
    public $UpdateDate;

    private function __construct()
    {
    }

    /**
     * Static constructor / factory
     */
    public static function create() {
        return new self();
    }

    //region Getters y Setters
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
     * @param string $Facebook
     * @return $this
     */
    public function setFacebook($Facebook)
    {
        $this->Facebook = $Facebook;
        return $this;
    }

    /**
     * @return string
     */
    public function getFacebook()
    {
        return $this->Facebook;
    }

    /**
     * @param string $Email
     * @return $this
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param string $FacebookId
     * @return $this
     */
    public function setFacebookId($FacebookId)
    {
        $this->FacebookId = $FacebookId;
        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->FacebookId;
    }

    /**
     * @param string $Id
     * @return $this
     */
    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Phone
     * @return $this
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->Phone;
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
     * @param integer $Status
     * @return $this
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
        return $this;
    }

    /**
     * @return integer
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

    /**
     * @param string $WebPage
     * @return $this
     */
    public function setWebPage($WebPage)
    {
        $this->WebPage = $WebPage;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebPage()
    {
        return $this->WebPage;
    }
    //endregion

} 