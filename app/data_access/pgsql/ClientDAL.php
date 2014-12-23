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
     * Registra un nuevo usuario y lo retorna con el Id que se le asignó
     * @param Client $newClient
     * @return Client
     */
    public function RegisterUser(Client $newClient)
    {
        $db = Database::get();
        $data = array(
            'gmail' => $newClient->getGmail(),
            'status'  => 1,
            'insertdate'  => 'now()'
        );
        $db->insert('client', $data);
        $id = $db->lastInsertId('client_id_seq');
        return $newClient->setId($id);
    }
}