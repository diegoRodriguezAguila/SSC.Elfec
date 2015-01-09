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
     * Registra una nueva cuenta y retorna el Id que se le asignó
     * @param Account $newAccount
     * @return int
     */
    public function RegisterAccount(Account $newAccount)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM accounts WHERE client_id = :client_id AND  nus = :nus AND account_number = :account_number",
            [':client_id' => $newAccount->getClientId(), ':nus' => $newAccount->getNUS(), ':account_number' => $newAccount->getAccountNumber()]);
        if(count($result)>0)
        {
            $updateData = array('status' => 1,'update_date'  => 'now()');
            $where=array('client_id' => $newAccount->getClientId(),'nus'=>$newAccount->getNUS());
            $db->update('accounts', $updateData,$where);
            return $result[0]['id'];
        }
        else // es nueva cuenta
        {
            $data = array(
                'client_id' => $newAccount->getClientId(),
                'account_number' => $newAccount->getAccountNumber(),
                'nus'  => $newAccount->getNUS(),
                'status'  => 1,
                'insert_date'  => 'now()'
            );
            $db->insert('accounts', $data);
            return $db->lastInsertId('accounts_id_seq');
        }
    }

    /**
     * Elimina una cuenta para un usuario determiando
     * @param $NUS
     * @param $ClientID
     * @return bool
     */
    public function DeleteAccount($NUS, $ClientID)
    {
        $db = Database::get();
        $data = array('status' => 0,'update_date'  => 'now()');
        $where=array('client_id' => $ClientID,'nus'=>$NUS);
        $db->update('accounts', $data,$where);
    }

}