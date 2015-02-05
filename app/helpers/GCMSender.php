<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 27-01-15
 * Time: 02:50 PM
 */

namespace helpers;


class GCMSender {
    /**
     * @param $deviceGCMTokens
     * @param $data
     * @return string
     */
    public static function sendDataToDevices($deviceGCMTokens, $data)
    {
        $fields = array
        (
            'registration_ids'  => $deviceGCMTokens,
            'data'              => $data
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
        if(defined (PROXY_SERVER))
            curl_setopt($ch, CURLOPT_PROXY, PROXY_SERVER);
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return $result;
    }
} 