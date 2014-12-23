<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 09:18 AM
 */

namespace data_access\pgsql;

/**
 * Clase que provee métodos para el acceso a datos de cuentas
 * Class AccountDAL
 * @package data_access
 */
use data_access\IAccountDAL;
use helpers\Database;
use models\Account;

class AccountDAL implements IAccountDAL
{
    /**
     * Registra una nueva cuenta y la retorna con el Id que se le asignó
     * @param Account $newAccount
     * @return Account
     */
    public function RegisterAccount(Account $newAccount)
    {
        $db = Database::get();

        $id = $db->lastInsertId('Id');
        $newAccount->setId($id);
        return $newAccount;
    }
}