<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 11-02-15
 * Time: 02:40 PM
 */

namespace business_logic;
use data_access\AccountDALFactory;
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
     * @param $clientId
     * @return bool
     */
    public static function clientHasAccount($NUS, $clientId)
    {
        $clientDAL = ClientDALFactory::instance();
        $accountResult = $clientDAL->findAccount($NUS, $clientId);
        return count($accountResult)>0;
    }

    /**
     * Verifica si es que el cliente tiene la cuenta con el nus proporcionado, sino la registra
     * @param $NUS
     * @param $accountNumber
     * @param $clientId
     */
    public static function addAccountToClient($NUS, $accountNumber, $clientId)
    {
        if(!self::clientHasAccount($NUS, $clientId))
        {
            $accountDAL = AccountDALFactory::instance();
            $accountDAL->RegisterAccount($NUS, $accountNumber, $clientId);
        }
    }

    /**
     * Verifica si es que un cliente tiene registrado un número telefónico
     * @param $phoneNumber
     * @param $clientId
     * @return bool
     */
    public static function clientHasPhoneNumber($phoneNumber,$clientId)
    {
        $clientDAL = ClientDALFactory::instance();
        $accountResult = $clientDAL->findPhoneNumber($phoneNumber, $clientId);
        return count($accountResult)>0;
    }

    /**
     * Verifica si es que el cliente tiene el numero de telefono proporcionado, sino lo registra
     */
    public static function addPhoneNumberToClient($phoneNumber, $clientId)
    {
        if(!self::clientHasPhoneNumber($phoneNumber, $clientId))
        {
            $phoneDAL = MobilePhoneDALFactory::instance();
            $phoneDAL->RegisterPhone(MobilePhone::create()->setClientId($clientId)->setNumber($PhoneNumber));
        }
    }

} 