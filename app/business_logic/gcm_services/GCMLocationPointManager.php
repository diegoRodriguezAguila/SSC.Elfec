<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 1/30/15
 * Time: 9:36 AM
 */

namespace business_logic\gcm_services;
use data_access\DeviceDALFactory;
use helpers\GCMSender;
use models\LocationPoint;
use models\web_services\WSResponse;
class GCMLocationPointManager {

    private static $MAX_DEVICES_PER_GCM = 1000;
    private static $p;
    public static function propagatePointsToAllDevices($points)
    {
        $deviceDAL = DeviceDALFactory::instance();
        $devices  = $deviceDAL->GetAllDevices();
        $totalDevices = count($devices);
        $counter = 1;
        $result=[];
        foreach($points as $point)
        {
            $serializedPoint=json_encode($point->JsonSerialize());
            array_push($result,$point->JsonSerialize());
        }
        $serializedPoints=($result);
        $msg = array
        (
            'message'       => 'Se actualizó la información de contacto de la empresa',
            'title'         => 'Información de contacto',
            'key'           => 'UpdatePoints',
            'points'        => ($serializedPoints) ,
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
        return "asd";
    }
} 