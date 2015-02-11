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

} 