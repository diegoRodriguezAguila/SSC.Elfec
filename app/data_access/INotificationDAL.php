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
     * @param $message
     * @param $outageCaseNumber
     * @param $outageType
     * @return integer
     */
    public function registerNotificationMessage($message, $outageCaseNumber, $outageType);
    /**
     * Registra un nuevo detalle de notificacion y retorna el Id que se le asignó
     * @param $notificationId
     * @param $nus
     * @return integer
     */
    public function registerNotificationDetail($notificationId, $nus);
} 