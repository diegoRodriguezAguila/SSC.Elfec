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
 * @return int
 */
interface IDeviceDAL {
    public function registerDevice($IMEI, $GCM, $brand, $model, $clientId);

    /**
     * Busca aquellos dispositivos que coincidan con el token e IMEI provistos
     * @param string $GCMToken
     * @param string $IMEI
     * @return array
     */
    public function findByTokenAndIMEI($GCMToken, $IMEI);
    /**
     * @param string $lastToken
     * @param string $IMEI
     * @param string $newToken
     */
    public function updateDevicesGCMToken($lastToken, $IMEI, $newToken);
    public function getAllDevices();
}