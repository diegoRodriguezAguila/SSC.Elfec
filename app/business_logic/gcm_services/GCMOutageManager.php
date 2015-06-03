<?php
/**
 * Created by Diego
 * Date: 06-02-15
 * Time: 02:05 PM
 */

namespace business_logic\gcm_services;

use models\enums\NotificationKey;
use models\enums\NotificationType;
use data_access\ClientDALFactory;
use helpers\GCMSender;
/**
 * Class GCMOutageManager provee de metodos necesarios para distintos tipos de envios
 * de notificaciones sobre cortes a travez de GCM
 * @package business_logic\gcm_services
 */
class GCMOutageManager {

    const MAX_DEVICES_PER_GCM = 1000;

    /**
     * Envia el mensaje de corte enviado por el administrador
     * @param $account
     * @param $message
     * @param $key
     */
    public static function sendOutageNotification($account, $message, $key)
    {
        $clientDAL = ClientDALFactory::instance();
        $owner = $clientDAL->getClientById($account->client_id);
        $devices  = $clientDAL->getClientDevicesByOwner($owner->gmail);
        $totalDevices = count($devices);
        $counter = 1;
        $msg = [
            'message'       => $message,
            'title'         => $key==NotificationKey::SCHEDULED_OUTAGE?'Corte programado':'Corte fortuito',
            'key'           => $key,
            'type'          => NotificationType::OUTAGE,
            'gmail'         => $owner->gmail
        ];
        $deviceTokens = array();
        for ($i = 0; $i < $totalDevices; $i++)
        {
            array_push($deviceTokens,$devices[$i]->gcm_token);
            $counter++;
            if($counter==self::MAX_DEVICES_PER_GCM)
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

    /**
     * Envia el mensaje de corte por mora a todos los dispositivos que hayan registrado la cuenta
     * @param $account , cuenta
     * @param $message , mensaje de falta de pago
     */
    public static function sendNonPaymentOutageNotification($account, $message)
    {
        $clientDAL = ClientDALFactory::instance();
        $owner = $clientDAL->getClientById($account->client_id);
        $devices  = $clientDAL->getClientDevicesByOwner($owner->gmail);
        $totalDevices = count($devices);
        $counter = 1;
        $msg = [
            'message'       => $message,
            'title'         => 'Corte por mora',
            'key'           => NotificationKey::NONPAYMENT_OUTAGE,
            'type'          => NotificationType::OUTAGE,
            'gmail'         => $owner->gmail
        ];
        $deviceTokens = array();
        for ($i = 0; $i < $totalDevices; $i++)
        {
            array_push($deviceTokens,$devices[$i]->gcm_token);
            $counter++;
            if($counter==self::MAX_DEVICES_PER_GCM)
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