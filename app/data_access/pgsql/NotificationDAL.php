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
use helpers\Session;
use models\enums\DataBaseType;

/**
 * Capa de acceso a datos para notificaciones
 * Class NotificationDAL
 * @package data_access\pgsql
 */
class NotificationDAL implements INotificationDAL {
    /**
     * Registra una nueva notificacion y retorna el Id que se le asignó
     * @param $message string
     * @param $outageCaseNumber string
     * @param $outageType integer
     * @param $userDBConnection array
     * @return integer
     */
    public function registerNotificationMessage($message, $outageCaseNumber, $outageType, $userDBConnection)
    {
        $db = Database::get($userDBConnection);
        $data = [
            'sender_user' => $db->currentUser(),
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
     * @param $userDBConnection array
     * @return integer
     */
    public function registerNotificationDetail($notificationId, $nus, $userDBConnection)
    {
        $db = Database::get($userDBConnection);
        $data = [
            'notification_id' => $notificationId,
            'nus' => $nus,
            'insert_date'  => 'now()'
        ];
        $db->insert('notification_details', $data);
        return $db->lastInsertId('notification_details_id_seq');
    }

    /**
     * Obtiene las notificaciones de cierto caso
     * @param $outageCaseNumber
     * @return array
     */
    public function getOutageCaseNotifications($outageCaseNumber)
    {
        $db = Database::get();
        return $db->select("SELECT outage_case_number, sender_user, message, insert_date FROM notification_messages
        where outage_case_number=:outage_case_number order by insert_date desc",
            [':outage_case_number'=>$outageCaseNumber]);
    }
}