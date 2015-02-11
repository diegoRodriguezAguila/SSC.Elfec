<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 02:03 PM
 */

namespace data_access\pgsql;


use data_access\IClientDAL;
use external_data_access\oracle\AccountDataReader;
use helpers\Database;
use models\Client;

class ClientDAL implements IClientDAL {

    /**
     * Registra un nuevo usuario y retorna el Id que se le asignó
     * @param string $gmail
     * @return int
     */
    public function registerClient($gmail)
    {
        $db = Database::get();
        $data = array(
            'gmail' => $gmail,
            'status'  => 1,
            'insert_date'  => 'now()'
        );
        $db->insert('clients', $data);
        return $db->lastInsertId('clients_id_seq');
    }

    /**
     * Obtiene los dispositivos que le pertenecen a un cliente
     * @param $clientId
     * @return array
     */
    public function getClientDevices($clientId)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM devices WHERE client_id=:client_id", array(':client_id'=>$clientId));
        return $result;
    }

    /**
     * Busca el  dispositivos asociado al cliente que coincida con el IMEI proporcionado
     * @param $IMEI
     * @param $clientId
     * @return array
     */
    public function findDevice($IMEI,$clientId)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM devices WHERE imei = :imei AND client_id=:client_id", array(':imei' => $IMEI,':client_id'=>$clientId));
        return $result;
    }

    /**
     * Obtiene todas las cuentas para un usuario
     * @param $Gmail
     * @return Array
     */
    public function GetAllAccounts($Gmail)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM clients c, accounts a WHERE a.client_id = c.id AND  c.gmail=:gmail AND a.status=1", array(':gmail'=>$Gmail));
         $data=array();
          foreach($result as $row)
          {
              $accounts=AccountDataReader::findAccountData($row->nus,$row->account_number,"V_INFO_CUENTA");
              $size=count($accounts);
              if($size>0)
              array_push($data,$accounts[0]);
          }
        return $data;
    }

    /**
     * Busca un cliente por su gmail
     * @param $gmail
     * @return int
     */
    public function getClientId($gmail)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM clients WHERE gmail = :gmail", array(':gmail' => $gmail));
        $size = count($result);
        return $size > 0? $result[0]->id : -1;
    }

    /**
     * Busca si la cuenta con el NUS indicado asociada al cliente
     * @param $NUS
     * @param $clientId
     * @return array
     */
    public function findAccount($NUS, $clientId)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM accounts WHERE client_id = :clientId AND nus = :NUS AND status = 1", array(':clientId' => $clientId, ':NUS' => $NUS));
        return $result;
    }

    /**
     * Busca el o los numeros telefónicos asociados al cliente
     * @param $phoneNumber
     * @param $clientId
     * @return array
     */
    public function findPhoneNumber($phoneNumber,$clientId)
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM mobile_phones WHERE client_id = :client_id AND number = :number ", array(':number' => $phoneNumber,':client_id'=>$clientId));
        return $result;
    }
}