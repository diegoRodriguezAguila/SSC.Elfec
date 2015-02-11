<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 11-02-15
 * Time: 02:40 PM
 */

namespace business_logic;
use data_access\ClientDALFactory;

/**
 * Class ClientManager Maneja la logica de negocio de clientes
 * @package business_logic
 */
class ClientManager {

    /**
     * Verifica si es que existe un cliente si no, entonces lo registra
     * @param string $gmail
     * @return int
     */
    public static function addClient($gmail)
    {
        $clientDAL = ClientDALFactory::instance();
        $clientId =  $clientDAL->GetClientId($gmail);

        if($clientId==-1)
        {
            $clientId = $clientDAL->RegisterClient($gmail);
        }
        return $clientId;
    }

    /**
     * Verifica si es que un cliente tiene registrada una cuenta
     * @param $NUS
     * @param $clientID
     * @return bool
     */
    public static function hasAccount($NUS, $clientID)
    {

    }

} 