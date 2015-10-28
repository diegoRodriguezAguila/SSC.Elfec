<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 02-06-15
 * Time: 03:02 PM
 */

namespace data_access;


interface INotificationDAL {
    /**
     * Registra una nueva notificacion y retorna el Id que se le asignó
     * @param $message string
     * @param $outageCaseNumber string
     * @param $outageType integer
     * @param $userDBConnection array
     * @return integer
     */
    public function registerNotificationMessage($message, $outageCaseNumber, $outageType, $userDBConnection);
    /**
     * Registra un nuevo detalle de notificacion y retorna el Id que se le asignó
     * @param $notificationId
     * @param $nus
     * @param $userDBConnection array
     * @return integer
     */
    public function registerNotificationDetail($notificationId, $nus, $userDBConnection);

    public function getOutageCaseNotifications($outageCaseNumber);
} 