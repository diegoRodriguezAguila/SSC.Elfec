<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 09:18 AM
 */

namespace data_access\PG;

/**
 * Clase que provee métodos estáticos para el acceso a datos
 * Class AccountDAL
 * @package data_access
 */
use data_access\IAccountDAL as IAccountDAL;
use models\Account;

class AccountDAL implements IAccountDAL
{
    /**
     * Registra una nueva cuenta y la retorna con el Id que se le asignó
     * @param Account $newAccount
     * @return Account
     */
    public static function RegisterAccount(Account $newAccount)
    {
        // TODO: Implement RegisterAccount() method.
    }

}