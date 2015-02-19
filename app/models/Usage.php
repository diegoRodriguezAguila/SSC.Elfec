<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 2/19/15
 * Time: 2:59 PM
 */

namespace models;


class Usage {

    private $Term;
    private $EnergyUsage;
    public static function create() {
        $instance = new self();
        return $instance;
    }
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * @param mixed $EnergyUsage
     */
    public function setEnergyUsage($EnergyUsage)
    {
        $this->EnergyUsage = $EnergyUsage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnergyUsage()
    {
        return $this->EnergyUsage;
    }

    /**
     * @param mixed $Term
     */
    public function setTerm($Term)
    {
        $this->Term = $Term;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerm()
    {
        return $this->Term;
    }



} 