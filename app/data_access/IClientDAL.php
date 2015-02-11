<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 11:53 AM
 */

namespace data_access;

/**
 * Provee de una interfáz para la abstracción de la capa de acceso a datos de usuarios
 * Interface IAccountDAL
 * @package data_access
 */
interface IClientDAL
{
    /**
     * Registra un nuevo cliente y retorna el Id que se le asignó
     * @param string $gmail
     * @return int
     */
    public function RegisterClient($gmail);
    /**
     * Busca un cliente por su gmail
     * @param $gmail
     * @return int
     */
    public function GetClientId($gmail);

    /**
     * Busca si la cuenta con el NUS indicado asociada al cliente
     * @param $NUS
     * @param $clientId
     * @return array
     */
    public function findAccount($NUS, $clientId);

    /**
     * Busca el o los numeros telefónicos asociados al cliente
     * @param $phoneNumber
     * @param $clientId
     * @return array
     */
    public function findPhoneNumber($phoneNumber,$clientId);
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
    public function getClientDevices($clientId);
} 