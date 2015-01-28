<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 28-01-15
 * Time: 10:22 AM
 */

namespace data_access;
use models\Contact;
/**
 * Provee de una interfáz para la abstracción de la capa de acceso a datos de contactos
 * Interface IAccountDAL
 * @package data_access
 */
interface IContactDAL {
    /**
     * Obtiene el contacto actual que se encuentre activo
     * Nota.- solo un contacto puede y debe estar activo al mismo tiempo
     * @return Contact
     */
    public function GetCurrentActiveContact();
} 