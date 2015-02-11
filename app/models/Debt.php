<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 11-02-15
 * Time: 11:10 AM
 */

namespace models;


use DateTime;

class Debt {
    private $Amount;
    private $Year;
    private $Month;
    private $ReceiptNumber;
    private $ExpirationDate;

    /**
     * @param double $Amount
     * @return $this
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
        return $this;
    }

    /**
     * @return double
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param DateTime $ExpirationDate
     * @return $this
     */
    public function setExpirationDate($ExpirationDate)
    {
        $this->ExpirationDate = $ExpirationDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpirationDate()
    {
        return $this->ExpirationDate;
    }

    /**
     * @param int $Month
     * @return $this
     */
    public function setMonth($Month)
    {
        $this->Month = $Month;
        return $this;
    }

    /**
     * @return int
     */
    public function getMonth()
    {
        return $this->Month;
    }

    /**
     * @param int $ReceiptNumber
     * @return $this
     */
    public function setReceiptNumber($ReceiptNumber)
    {
        $this->ReceiptNumber = $ReceiptNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getReceiptNumber()
    {
        return $this->ReceiptNumber;
    }

    /**
     * @param int $Year
     * @return $this
     */
    public function setYear($Year)
    {
        $this->Year = $Year;
        return $this;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->Year;
    }

} 