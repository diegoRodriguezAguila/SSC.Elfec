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

    /**
     * Verifica si es que un usuario ya tiene agregado un dispositivo
     * @param $IMEI
     * @return bool
     */
    public function HasDevice($IMEI,$ClientId)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM clients c, devices d WHERE d.client_id = c.id AND imei = :imei AND d.client_id=:client_id", array(':imei' => $IMEI,':client_id'=>$ClientId));
        $size = count($result);
        return $size > 0;
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
        $result  = $db->select("SELECT * FROM clients c, accounts a WHERE a.client_id = c.id AND gmail = :gmail AND nus = :NUS AND a.status = 1", array(':gmail' => $gmail, ':NUS' => $NUS));
        $size = count($result);
        return $size > 0;
    }


    /**
     * Verifica si es que un usuario ya tiene agregado un telefono
     * @param $phoneNumber
     * @return bool
     */
    public function HasPhoneNumber($phoneNumber,$ClientId)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM clients c, mobile_phones m WHERE m.client_id = c.id AND number = :number AND m.client_id=:client_id", array(':number' => $phoneNumber,':client_id'=>$ClientId));
        $size = count($result);
        return $size > 0;
    }
}