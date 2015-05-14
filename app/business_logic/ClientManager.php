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

use external_data_access\oracle\AccountEDAL;
use data_access\DeviceDALFactory;
use data_access\MobilePhoneDALFactory;

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

    public static function getOwners($accounts)
    {
        $accountDAL = ClientDALFactory::instance();
        return $accountDAL->getOwners($accounts);
    }
    /**
     * Verifica si es que el cliente tiene la cuenta con el nus proporcionado, sino la registra
     * @param $NUS
     * @param $accountNumber
     * @param $clientId
     * @return int
     */
    public static function addAccountToClient($NUS, $accountNumber, $clientId)
    {
        $clientDAL = ClientDALFactory::instance();
        $accountResult = $clientDAL->findAccount($NUS, $clientId);
        if(!count($accountResult)>0)
        {
            $accountDAL = AccountDALFactory::instance();
            return $accountDAL->registerAccount($NUS, $accountNumber, $clientId);
        }
        return $accountResult[0]->id;
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
        $phoneResult = $clientDAL->findPhoneNumber($phoneNumber, $clientId);
        return count($phoneResult)>0;
    }

    /**
     * Verifica si es que el cliente tiene el numero de telefono proporcionado, sino lo registra
     */
    public static function addPhoneNumberToClient($phoneNumber, $clientId)
    {
        if($phoneNumber!="" && !self::clientHasPhoneNumber($phoneNumber, $clientId))
        {
            $phoneDAL = MobilePhoneDALFactory::instance();
            $phoneDAL->registerPhone($phoneNumber, $clientId);
        }
    }

    /**
     * Verifica si es que un cliente tiene registrado un dispositivo
     * @param $IMEI
     * @param $clientId
     * @return bool
     */
    public static function clientHasDevice($IMEI,$clientId)
    {
        $clientDAL = ClientDALFactory::instance();
        $deviceResult = $clientDAL->findDevice($IMEI, $clientId);
        return count($deviceResult)>0;
    }

    /**
     * Verifica si es que el cliente tiene el dispositivo con el IMEI proporcionado, sino lo registra
     */
    public static function addDeviceToClient($IMEI, $GCM, $brand, $model, $clientId)
    {
        if(!self::clientHasDevice($IMEI, $clientId))
        {
            $deviceDAL = DeviceDALFactory::instance();
            $deviceDAL->registerDevice($IMEI, $GCM, $brand, $model, $clientId);
        }
    }
    /**
     * Obtiene todas las cuentas de un cliente
     */
    public static function getAllAccounts($gmail)
    {
        $clientDAL=ClientDALFactory::instance();
        $result=$clientDAL->GetAllAccounts($gmail);
        $accounts=array();
        foreach($result as $row)
        {
          $account=  AccountManager::getFullAccountData($row->id);
          array_push($accounts, $account->jsonSerialize());
        }
        return $accounts;
    }

} 