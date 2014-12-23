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
     * Registra un nuevo usuario y lo retorna con el Id que se le asignó
     * @param Client $newClient
     * @return Client
     */
    public function RegisterUser(Client $newClient);
} 