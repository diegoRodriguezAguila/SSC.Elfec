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
            'insertdate'  => 'now()'
        );
        $db->insert('client', $data);
        return $db->lastInsertId('client_id_seq');
    }

    /**
     * Busca un cliente por su gmail
     * @param $gmail
     * @return int
     */
    public function GetClientId($gmail)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM client WHERE gmail = :gmail", array(':gmail' => $gmail));
        $size = count($result);
        return $size > 0? $result[0]->id : -1;
    }

}