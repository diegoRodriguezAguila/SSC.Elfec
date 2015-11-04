<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 4/11/15
 * Time: 9:47
 */

namespace models\enums;

/**
 * Class OutageType
 * Representa el tipo de corte para registrar una notificación
 * @package models\enums
 */
class OutageType {
    /**
     * Tipo de corte no definido
     */
    const UNDEFINED = -1;
    /**
     * Tipo de corte programado
     */
    const SCHEDULED = 0;
    /**
     * Tipo de corte incidental
     */
    const INCIDENTAL = 1;
    /**
     * Tipo de corte por mora
     */
    const NON_PAYMENT = 2;
    /**
     * Tipo de corte por mora
     */
    const EXPIRED_DEBT = 3;
} 