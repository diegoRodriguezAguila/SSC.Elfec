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
        $db = Database::get();
        return $db->select("SELECT * FROM devices WHERE imei=:imei and gcm_token=:gcm_token",
            [':imei'=>$IMEI, ':gcm_token'=>$GCMToken]);
    }
    /**
     * @param string $lastToken
     * @param string $IMEI
     * @param string $newToken
     */
    public function updateDevicesGCMToken($lastToken, $IMEI, $newToken)
    {
        $db = Database::get();
        $sql = "UPDATE devices SET gcm_token = :newToken WHERE imei = :IMEI AND gcm_token = :lastToken";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':newToken', $newToken, Database::PARAM_STR);
        $stmt->bindParam(':IMEI', $IMEI, Database::PARAM_STR);
        $stmt->bindParam(':lastToken', $lastToken, Database::PARAM_STR);
        $stmt->execute();
    }

} 