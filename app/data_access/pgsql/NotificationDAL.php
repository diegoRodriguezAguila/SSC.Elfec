<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 02-06-15
 * Time: 03:04 PM
 */

namespace data_access\pgsql;


use data_access\INotificationDAL;
use helpers\Database;
/**
 * Capa de acceso a datos para notificaciones
 * Class NotificationDAL
 * @package data_access\pgsql
 */
class NotificationDAL implements INotificationDAL {
    /**
     * Registra una nueva notificacion y retorna el Id que se le asignó
     * @param $message
     * @param $outageCaseNumber
     * @param $outageType
     * @return integer
     */
    public function registerNotificationMessage($message, $outageCaseNumber, $outageType)
    {
        $db = Database::get();
        $data = [
            'sender_user' => 'session_user',
            'message' => $message,
            'insert_date'  => 'now()',
            'outage_case_number'  => $outageCaseNumber,
            'outage_type'  => $outageType
        ];
        $db->insert('notification_messages', $data);
        return $db->lastInsertId('notification_messages_id_seq');
    }

    /**
     * Registra un nuevo detalle de notificacion y retorna el Id que se le asignó
     * @param $notificationId
     * @param $nus
     * @return integer
     */
    public function registerNotificationDetail($notificationId, $nus)
    {
        $db = Database::get();
        $data = [
            'notification_id' => $notificationId,
            'nus' => $nus,
            'insert_date'  => 'now()'
        ];
        $db->insert('notification_details', $data);
        return $db->lastInsertId('notification_details_id_seq');
    }
} 