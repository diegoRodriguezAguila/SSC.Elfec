<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 06-02-15
 * Time: 03:46 PM
 */

namespace models\enums;

/**
 * Representa los tipos de grupos de notificaciones
 * @author Diego
 *
 */
class NotificationType {
    /**
     * Grupo de notificaciones de tipo de corte de luz o de informaciones
     */
    const OUTAGE_OR_INFO = 0;
    /**
     * Grupo de notificaciones de tipo de cuentas
     */
    const ACCOUNT = 1;
    /**
     * Grupo de otro tipo de notificaciones que no son ni cortes ni cuentas
     */
    const OTHERS = 2;
} 