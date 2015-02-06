<?php
/**
 * Created by Diego
 * Date: 28-01-15
 * Time: 09:16 AM
 */

namespace business_logic\gcm_services;
use data_access\DeviceDALFactory, models\Contact;
use models\enums\NotificationKey;
use models\enums\NotificationType;

/**
 * Class GCMContactManager provee de metodos necesarios para distintos tipos de envios de información de contactos a los dispositivos
 * a travez
 * @package business_logic\gcm_services
 */
class GCMContactManager {

    private static $MAX_DEVICES_PER_GCM = 1000;
    /**
     * Propagates a new contact data to all devices
     * @param Contact $newContact
     */
    public static function propagateContactUpdateToAllDevices($newContact)
    {
        $deviceDAL = DeviceDALFactory::instance();
        $devices  = $deviceDAL->GetAllDevices();
        $totalDevices = count($devices);
        $counter = 1;
        $msg = array
        (
            'message'       => 'Se actualizó la información de contacto de la empresa',
            'title'         => 'Información de contacto',
            'key'           => NotificationKey::CONTACTS_UPDATE,
            'type'          => NotificationType::OTHERS,
            'phone'           => $newContact->getPhone(),
            'address'        => $newContact->getAddress(),
            'email'         => $newContact->getEmail(),
            'web_page'         => $newContact->getWebPage(),
            'facebook'         => $newContact->getFacebook(),
            'facebook_id'         => $newContact->getFacebookId()
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