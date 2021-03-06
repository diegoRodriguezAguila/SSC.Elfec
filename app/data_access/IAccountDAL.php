<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 09:53 AM
 */

namespace data_access;

/**
 * Provee de una interfáz para la abstracción de la capa de acceso a datos de cuentas
 * Interface IAccountDAL
 * @package data_access
 */
interface IAccountDAL
{
    public function getAll();
    /**
     * Registra una nueva cuenta y retorna el Id que se le asignó
     * @param $NUS
     * @param $clientId
     * @return int
     */
    public function registerAccount($NUS, $clientId);
    /**
     * Elimina una cuenta para un usuario determiando
     * @param $NUS
     * @param $ClientID
     * @return bool
     */
    public function deleteAccount($NUS,$ClientID);

    /**
     * Busca la cuenta con el id respectivo
     * @param $accountId
     * @return Array
     */
    public function findAccount($accountId);

    /**
     * Obtiene las cuentas que se encuentren en la condicion IN de nuses
     * @param $nusINClause
     * @return array
     */
    public function findAccountsINClause($nusINClause);

}