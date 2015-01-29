<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 11:53 AM
 */

namespace data_access;

use models\Client;
/**
 * Provee de una interfáz para la abstracción de la capa de acceso a datos de usuarios
 * Interface IAccountDAL
 * @package data_access
 */
interface IClientDAL
{
    /**
     * Registra un nuevo cliente y retorna el Id que se le asignó
     * @param Client $newClient
     * @return int
     */
    public function RegisterClient(Client $newClient);
    /**
     * Busca un cliente por su gmail
     * @param $gmail
     * @return int
     */
    public function GetClientId($gmail);

    /**
     * Verifica si es que un usuario ya tiene agregada una cuenta
     * @param $gmail
     * @param $NUS
     * @return bool
     */
    public function HasAccount($gmail, $NUS);
    /**
     * Verifica si es que un usuario ya tiene agregado un telefono
     * @param $phoneNumber
     * @param $ClientId
     * @return bool
     */
    public function HasPhoneNumber($phoneNumber,$ClientId);
    /**
     * Verifica si es que un usuario ya tiene agregado un dispositivo
     * @param $IMEI
     * @param $ClientID
     * @return bool
     */
    public function HasDevice($IMEI,$ClientID);
    /**
     * Obtiene todas las cuentas para un usuario
     * @param $ClientID
     * @return Array
     */
    public function GetAllAccounts($ClientID);
    /**
     * Obtiene los dispositivos que le pertenecen a un cliente
     * @param $clientId
     * @return array
     */
    public function getMyDevices($clientId);
} 