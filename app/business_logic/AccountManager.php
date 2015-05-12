<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 10-02-15
 * Time: 03:16 PM
 */

namespace business_logic;
use data_access\AccountDALFactory;
use external_data_access\oracle\AccountDataReader;
use models\Account;
use models\Debt;
use models\Usage;

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
        $result = AccountDataReader::findAccountData($NUS, $AccountNumber, AccountDataReader::V_ACCOUNT_INFO);
        return count($result)>=1;
    }

    public static function getUsageFromAccount($NUS)
    {
        $result=array();
       $usage=AccountDataReader::getUsageFromAccount($NUS);
        foreach($usage as $item)
        {
            array_push($result,Usage::create()->setEnergyUsage($item->CONSUMO)->setTerm($item->GESTION)->jsonSerialize());
        }
        return $result;
    }
    /**
     * Devuelve una cuenta con su información completa de deudas, direción y nombre
     * @param $accountId
     * @return Account
     */
    public static function getFullAccountData($accountId)
    {
        $accountDAL = AccountDALFactory::instance();
        $accResult = $accountDAL->findAccount($accountId);
        if(count($accResult)>0)
        {
            $foundAccount = $accResult[0];
            $fullAccount = Account::create()->setAccountNumber($foundAccount->account_number)
                ->setNUS($foundAccount->nus);
            $extraDataResult = AccountDataReader::findAccountData($foundAccount->nus, $foundAccount->account_number,AccountDataReader::V_ACCOUNT_INFO );
            $fullAccount->setAccountOwner($extraDataResult[0]->NOMBRE)
                ->setAddress($extraDataResult[0]->DIRECCION)
                ->setEnergySupplyStatus($extraDataResult[0]->ESTADO);
            foreach($extraDataResult as $extraData)
            {
                array_push($fullAccount->Debts,
                Debt::create()->setAmount($extraData->TOTALIMP)
                              ->setExpirationDate($extraData->FECHA_VTO)
                              ->setMonth($extraData->MES)
                              ->setYear($extraData->ANIO)
                              ->setReceiptNumber($extraData->NROCBTE));
            }
            return $fullAccount;
        }
        return null;
    }
} 