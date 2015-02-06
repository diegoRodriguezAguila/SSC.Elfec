<?php
/**
 * Created by Diego
 * Date: 06-02-15
 * Time: 02:05 PM
 */

namespace business_logic\gcm_services;

use models\enums\NotificationType;

/**
 * Class GCMOutageManager provee de metodos necesarios para distintos tipos de envios
 * de notificaciones sobre cortes a travez de GCM
 * @package business_logic\gcm_services
 */
class GCMOutageManager {

    public static function sendOutageNotification($notificationKey, $message)
    {
        $deviceDAL = DeviceDALFactory::instance();
        $devices  = $deviceDAL->GetAllDevices();
        $totalDevices = count($devices);
        $counter = 1;
        $msg = array
        (
            'message'       => $message,
            'title'         => 'Corte programado',
            'key'           => $notificationKey,
            'type'          => NotificationType::OUTAGE,
        );
        $deviceTokens = array();
        for ($i = 0; $i < $totalDevices; $i++)
        {
            array_push($deviceTokens,$devices[$i]->gcm_token);
            $counter++;
            if($counter==self::$MAX_DEVICES_PER_GCM)
            {
                $counter=1;
                GCMSender::sendDataToDevices($deviceTokens,$msg);
                $deviceTokens = array();
            }
        }
        if($counter>1)
        {
            GCMSender::sendDataToDevices($deviceTokens,$msg);
        }
    }
} 