<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 12/24/14
 * Time: 5:31 PM
 */

namespace data_access\pgsql;


use data_access\Client;
use data_access\IMobilePhoneDAL;
use helpers\Database;
use models\MobilePhone;

class MobilePhoneDAL implements IMobilePhoneDAL {

    /**
     * Registra un nuevo telefono relacionado a un cliente y retorna el Id que se le asignó
     * @param $phoneNumber
     * @param $clientId
     * @return int
     */
    public function registerPhone($phoneNumber, $clientId)
    {
        $db = Database::get();
        $data = array(
            'number' => $phoneNumber,
            'client_id' => $clientId,
            'status'  => 1,
            'insert_date'  => 'now()'
        );
        $db->insert('mobile_phones', $data);
        return $db->lastInsertId('mobile_phones_id_seq');
    }
}