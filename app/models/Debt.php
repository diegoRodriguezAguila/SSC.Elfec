<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 11-02-15
 * Time: 11:10 AM
 */

namespace models;


class Debt {
    private $Amount;
    private $Year;
    private $Month;
    private $ReceiptNumber;
    private $ExpirationDate;

    /**
     * @param mixed $Amount
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param mixed $ExpirationDate
     */
    public function setExpirationDate($ExpirationDate)
    {
        $this->ExpirationDate = $ExpirationDate;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->ExpirationDate;
    }

    /**
     * @param mixed $Month
     */
    public function setMonth($Month)
    {
        $this->Month = $Month;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->Month;
    }

    /**
     * @param mixed $ReceiptNumber
     */
    public function setReceiptNumber($ReceiptNumber)
    {
        $this->ReceiptNumber = $ReceiptNumber;
    }

    /**
     * @return mixed
     */
    public function getReceiptNumber()
    {
        return $this->ReceiptNumber;
    }

    /**
     * @param mixed $Year
     */
    public function setYear($Year)
    {
        $this->Year = $Year;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->Year;
    }

} 