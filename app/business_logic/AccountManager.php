<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 10-02-15
 * Time: 03:16 PM
 */

namespace business_logic;
use external_data_access\oracle\AccountDataReader;

/**
 * Class AccountManager Maneja la información de las cuentas y su lógica de negocio
 * @package business_logic
 */
class AccountManager {

    /**
     * Valida si es que una cuenta corresponde a un nus y su número, conectando a la base
     * de datos oracle
     * @param string $NUS
     * @param string $AccountNumber
     * @return bool
     */
    public static function isAValidAccount($NUS, $AccountNumber)
    {
        $result = AccountDataReader::findAccountData($NUS, $AccountNumber, AccountDataReader::V_INFO_CUENTA);
        return count($result)>=1;
    }
} 