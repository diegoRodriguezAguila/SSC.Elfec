<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 09-06-15
 * Time: 04:57 PM
 */

namespace data_access;

/**
 * Provee de una interfáz para la abstracción de la capa de acceso a datos de aplicación
 * Interface IAccountDAL
 * @package data_access
 */
interface IAppDAL {
    /**
     * Obtiene la ultima información de la aplicación válida
     * @return array
     */
    public function getLastAppInfo();

    /**
     * Obtiene todas las información de la aplicación válidas
     * @return array|null
     */
    public function getAllValidAppInfos();
} 