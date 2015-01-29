<?php
/**
 * Created by Zuki
 * Date: 12/26/14
 * Time: 9:15 PM
 */

namespace data_access;
use models\Client;
use models\Device;
/**
 * Registra un nuevo Dispositivo y retorna el Id que se le asignó
 * @param Device $device
 * @return int
 */
interface IDeviceDAL {
    public function RegisterDevice(Device $device);
    public function GetAllDevices();
}