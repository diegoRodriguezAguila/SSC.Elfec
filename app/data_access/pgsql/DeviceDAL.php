<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 12/28/14
 * Time: 9:14 PM
 */

namespace data_access\pgsql;
use data_access\Client;
use data_access\IDeviceDAL;
use helpers\Database;
use models\Device;

class DeviceDAL implements IDeviceDAL{
    public function registerDevice($IMEI, $GCM, $brand, $model, $clientId)
    {
        $db = Database::get();
        $data = array(
            'imei' => $IMEI,
            'client_id' => $clientId,
            'gcm_token' => $GCM,
            'brand' => $brand,
            'model' => $model,
            'status'  => 1,
            'insert_date'  => 'now()'
        );
        $db->insert('devices', $data);
        return $db->lastInsertId('devices_id_seq');
    }

    public function getAllDevices()
    {
        $db = Database::get();
        return $db->select("SELECT * FROM devices WHERE status=1");
    }

    /**
     * Busca aquellos dispositivos que coincidan con el token e IMEI provistos
     * @param string $GCMToken
     * @param string $IMEI
     * @return array
     */
    public function findByTokenAndIMEI($GCMToken, $IMEI)
    {
		//Ya no se usa GCMToken para identificar dispositivo, es muy variable
        $db = Database::get();
        return $db->select("SELECT * FROM devices WHERE imei=:imei",
            [':imei'=>$IMEI]);
    }
    /**
     * @param string $lastToken
     * @param string $IMEI
     * @param string $newToken
     */
    public function updateDevicesGCMToken($lastToken, $IMEI, $newToken)
    {
		//Ya no se usa GCMToken para identificar dispositivo, es muy variable
        $db = Database::get();
        $sql = "UPDATE devices SET gcm_token = :newToken WHERE imei = :IMEI";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':newToken', $newToken, Database::PARAM_STR);
        $stmt->bindParam(':IMEI', $IMEI, Database::PARAM_STR);
        $stmt->execute();
    }

} 