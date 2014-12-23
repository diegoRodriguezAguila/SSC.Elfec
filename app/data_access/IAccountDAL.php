<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 23-12-14
 * Time: 09:53 AM
 */

namespace data_access;

use models\Account;
/**
 * Provee de una interfáz para la abstracción de la capa de acceso a datos de cuentas
 * Interface IAccountDAL
 * @package data_access
 */
interface IAccountDAL
{
    /**
     * Registra una nueva cuenta y la retorna con el Id que se le asignó
     * @param Account $newAccount
     * @return Account
     */
    public static function RegisterAccount(Account $newAccount);
}