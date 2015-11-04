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



    /**
     * Envia el mensaje de corte enviado por el administrador
     * @param $account
     * @param $message
     * @param $key
     */
    public static function sendOutageNotification($account, $message, $key)
    {
        self::sendMessageToAccount($account, $message, $key==NotificationKey::SCHEDULED_OUTAGE?'Corte programado':'Corte fortuito',
            $key, NotificationType::OUTAGE_OR_INFO);
    }

    /**
     * Envia el mensaje de corte por mora a todos los dispositivos que hayan registrado la cuenta
     * @param $account , cuenta
     * @param $message , mensaje de falta de pago
     */
    public static function sendNonPaymentOutageNotification($account, $message)
    {
        self::sendMessageToAccount($account, $message, 'Corte por mora', NotificationKey::NONPAYMENT_OUTAGE, NotificationType::OUTAGE_OR_INFO);
    }

    /**
     * Envia el mensaje de factura vencida a todos los dispositivos que hayan registrado la cuenta
     * @param $account , cuenta
     * @param $message , mensaje de factura vencida
     */
    public static function sendExpiredDebtNotification($account, $message)
    {
        self::sendMessageToAccount($account, $message, 'Vencimiento de factura', NotificationKey::EXPIRED_DEBT, NotificationType::OUTAGE_OR_INFO);
    }

    /**
     * Envia un mensaje a todos los dispositivos de una cuenta
     * @param $account
     * @param $message
     * @param $title
     * @param $key
     * @param $type
     */
    private static function sendMessageToAccount($account, $message, $title, $key, $type)
    {
        $clientDAL = ClientDALFactory::instance();
        $owner = $clientDAL->getClientById($account->client_id);
        $devices  = $clientDAL->getClientDevicesByOwner($owner->gmail);
        $msg = [
            'message'       => $message,
            'title'         => $title,
            'key'           => $key,
            'type'          => $type,
            'gmail'         => $owner->gmail
        ];
        GCMSender::sendMessageToDevices($devices,$msg);
    }
} 