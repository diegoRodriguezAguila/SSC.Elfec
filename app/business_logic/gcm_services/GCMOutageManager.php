<?php
/**
 * Created by Diego
 * Date: 06-02-15
 * Time: 02:05 PM
 */

namespace business_logic\gcm_services;

use models\enums\NotificationKey;
use models\enums\NotificationType;
use data_access\DeviceDALFactory;
use data_access\ClientDALFactory;
use data_access\pgsql\ClientDAL;
use helpers\GCMSender;
/**
 * Class GCMOutageManager provee de metodos necesarios para distintos tipos de envios
 * de notificaciones sobre cortes a travez de GCM
 * @package business_logic\gcm_services
 */
class GCMOutageManager {

    private static $MAX_DEVICES_PER_GCM = 1000;
    private static $NON_PAYMENT_MESSAGE ='Estimado cliente, se le informa que la cuenta con NUS: <b>%s</b> es pasible a corte a partir de la fecha de mañana: <b>%s</b>. Le recomendamos pagar todas sus deudas pendientes, para evitar quedarse sin suministro de energía.';

    public static function sendIncidentalOutageNotification($owner, $message)
    {
        $clientDAL = ClientDALFactory::instance();
        $devices  = $clientDAL->getClientDevicesByOwner($owner);
        $totalDevices = count($devices);
        $counter = 1;
        $msg = array
        (
            'message'       => $message,
            'title'         => 'Corte fortuito',
            'key'           => NotificationKey::INCIDENTAL_OUTAGE,
            'type'          => NotificationType::OUTAGE,
            'gmail'         => $owner
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


    public static function sendScheduledOutageNotification($location,$message)
    {
        $deviceDAL = DeviceDALFactory::instance();
        //get devices by location
        $devices  = $deviceDAL->GetAllDevices();
        $totalDevices = count($devices);
        $counter = 1;
        $msg = array
        (
            'message'       => $message,
            'title'         => 'Corte programado',
            'key'           => NotificationKey::SCHEDULED_OUTAGE,
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

    /**
     * Envia el mensaje de corte por mora a todos los dispositivos que hayan registrado la cuenta
     * @param $account cuenta
     */
    public static function sendNonPaymentOutageNotification($account)
    {
        $clientDAL = ClientDALFactory::instance();
        $owner = $clientDAL->getClientById($account->client_id);
        $devices  = $clientDAL->getClientDevicesByOwner($owner->gmail);
        $totalDevices = count($devices);
        $counter = 1;
        $msg = array
        (
            'message'       => sprintf(self::$NON_PAYMENT_MESSAGE, $account->nus, (new \DateTime('tomorrow'))->format('d/m/Y')),
            'title'         => 'Corte por mora',
            'key'           => NotificationKey::NONPAYMENT_OUTAGE,
            'type'          => NotificationType::OUTAGE,
            'gmail'         => $owner->gmail
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