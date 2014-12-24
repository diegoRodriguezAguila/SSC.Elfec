<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 02:03 PM
 */

namespace data_access\pgsql;


use data_access\IClientDAL;
use helpers\Database;
use models\Client;

class ClientDAL implements IClientDAL {

    /**
     * Registra un nuevo usuario y retorna el Id que se le asignó
     * @param Client $newClient
     * @return int
     */
    public function RegisterClient(Client $newClient)
    {
        $db = Database::get();
        $data = array(
            'gmail' => $newClient->getGmail(),
            'status'  => 1,
            'insert_date'  => 'now()'
        );
        $db->insert('clients', $data);
        return $db->lastInsertId('clients_id_seq');
    }

    /**
     * Busca un cliente por su gmail
     * @param $gmail
     * @return int
     */
    public function GetClientId($gmail)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM clients WHERE gmail = :gmail", array(':gmail' => $gmail));
        $size = count($result);
        return $size > 0? $result[0]->id : -1;
    }

    /**
     * Verifica si es que un usuario ya tiene agregada una cuenta
     * @param $gmail
     * @param $NUS
     * @return bool
     */
    public function HasAccount($gmail, $NUS)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM clients c, accounts a WHERE a.client_id = c.id AND gmail = :gmail AND nus = :NUS", array(':gmail' => $gmail, ':NUS' => $NUS));
        $size = count($result);
        return $size > 0;
    }


    /**
     * Verifica si es que un usuario ya tiene agregado un telefono
     * @param $phoneNumber
     * @return bool
     */
    public function HasPhoneNumber($phoneNumber)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM clients c, mobile_phones m WHERE m.client_id = c.id AND number = :number", array(':number' => $phoneNumber));
        $size = count($result);
        return $size > 0;
    }
}