<?php
/**
 * Created by Zuki
 * Date: 1/2/15
 * Time: 11:39 AM
 */

namespace models;

use DateTime;
class PayPoint {
    private $Address;
    private $Phone;
    private $StartAttention;
    private $EndAttention;
    private $Latitude;
    private $Longitude;
    private $Status;
    private $InsertDate;
    private $UpdateDate;

    /**
     * @param string $Address
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param string $EndAttention
     */
    public function setEndAttention($EndAttention)
    {
        $this->EndAttention = $EndAttention;
    }

    /**
     * @return string
     */
    public function getEndAttention()
    {
        return $this->EndAttention;
    }

    /**
     * @param DateTime $InsertDate
     */
    public function setInsertDate($InsertDate)
    {
        $this->InsertDate = $InsertDate;
    }

    /**
     * @return DateTime
     */
    public function getInsertDate()
    {
        return $this->InsertDate;
    }

    /**
     * @param double $Latitude
     */
    public function setLatitude($Latitude)
    {
        $this->Latitude = $Latitude;
    }

    /**
     * @return double
     */
    public function getLatitude()
    {
        return $this->Latitude;
    }

    /**
     * @param double $Longitude
     */
    public function setLongitude($Longitude)
    {
        $this->Longitude = $Longitude;
    }

    /**
     * @return double
     */
    public function getLongitude()
    {
        return $this->Longitude;
    }

    /**
     * @param string $Phone
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->Phone;
    }

    /**
     * @param string $StartAttention
     */
    public function setStartAttention($StartAttention)
    {
        $this->StartAttention = $StartAttention;
    }

    /**
     * @return string
     */
    public function getStartAttention()
    {
        return $this->StartAttention;
    }

    /**
     * @param int $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
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
     */
    public function setUpdateDate($UpdateDate)
    {
        $this->UpdateDate = $UpdateDate;
    }

    /**
     * @return DateTime
     */
    public function getUpdateDate()
    {
        return $this->UpdateDate;
    }

} 