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
     * @param MobilePhone $newClient
     * @return int
     */
    public function RegisterPhone(MobilePhone $phone)
    {
        $db = Database::get();
        $data = array(
            'number' => $phone->Number,
            'client_id' => $phone->ClientId,
            'status'  => 1,
            'insert_date'  => 'now()'
        );
        $db->insert('mobile_phones', $data);
        return $db->lastInsertId('mobile_phones_id_seq');
    }
}