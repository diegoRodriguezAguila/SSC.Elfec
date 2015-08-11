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

class AccountDAL implements IAccountDAL
{
    /**
     * Registra una nueva cuenta y retorna el Id que se le asignó
     * @param $NUS
     * @param $clientId
     * @return int
     */
    public function registerAccount($NUS,$clientId)
    {
        $db = Database::get();
        $data = [
            'client_id' => $clientId,
            'nus'  => $NUS,
            'status'  => 1,
            'insert_date'  => 'now()'
        ];
        $db->insert('accounts', $data);
        return $db->lastInsertId('accounts_id_seq');
    }

    /**
     * Elimina una cuenta para un usuario determiando
     * @param $NUS
     * @param $ClientID
     * @return bool
     */
    public function deleteAccount($NUS, $ClientID)
    {
        $db = Database::get();
        $data = array('status' => 0,'update_date'  => 'now()');
        $where=array('client_id' => $ClientID,'nus'=>$NUS);
        $db->update('accounts', $data,$where);
    }
    /**
     * Busca la cuenta con el id respectivo
     * @param $accountId
     * @return Array
     */
    public function findAccount($accountId)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM accounts WHERE status=1 AND id=:account_id", array(':account_id'=>$accountId));
        return $result;
    }



    public function getAll()
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM accounts WHERE status=1");
        return $result;

    }

    /**
     * Obtiene las cuentas que se encuentren en la condicion IN de nuses
     * @param $nusINClause
     * @return array
     */
    public function findAccountsINClause($nusINClause)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM accounts WHERE status=1 AND nus ".$nusINClause);
        return $result;
    }
}