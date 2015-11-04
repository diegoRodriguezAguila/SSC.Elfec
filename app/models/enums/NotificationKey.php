<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 06-02-15
 * Time: 02:51 PM
 */

namespace models\enums;

/**
 * Representa las distintas keys de notificaciones
 * @author Diego
 *
 */
class NotificationKey {
    /**
     * Notificación de que se agregó una nueva cuenta para ese cliente en otro dispositivo
     */
    const NEW_ACCOUNT = "NewAccount";
    /**
     * Notificación de que se eliminó una cuenta del cliente en otro dispositivo
     */
    const ACCOUNT_DELETED = "AccountDeleted";
    /**
     * Notificación de que se añadieron puntos de ubicación
     */
    const POINTS_UPDATE = "PointsUpdate";
    /**
     * Notificación de que se actualizaron los contactos de la empresa
     */
    const CONTACTS_UPDATE = "ContactsUpdate";
    /**
     * Notificación de corte programado
     */
    const SCHEDULED_OUTAGE = "ScheduledOutage";
    /**
     * Notificación de corte fortuito por incidente
     */
    const INCIDENTAL_OUTAGE = "IncidentalOutage";
    /**
     * Notificación de corte por no pago
     */
    const NONPAYMENT_OUTAGE = "NonpaymentOutage";
    /**
     * Key de Notificación indefinido
     */
    const MISCELLANEOUS = "Miscellaneous";
    /**
     * Notificación de vencimiento de factura
     */
    const EXPIRED_DEBT = "ExpiredDebt";

}