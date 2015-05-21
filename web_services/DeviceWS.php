<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 21-05-15
 * Time: 09:11 AM
 */
include_once("lib/nusoap.php");
include_once("auto_load.php");
use \business_logic\DeviceManager,
    models\web_services\WSResponse,
    models\web_services\WSValidationResult;


$server = new soap_server();
$server->configureWSDL('ssc_elfec', 'urn:ssc_elfec');


$server->register('UpdateDeviceGCMToken',
    ['lastToken' => 'xsd:string','IMEI' => 'xsd:string', 'newToken' => 'xsd:string'],
    ['Response' => 'xsd:string'],'xsd:ssc_elfec');
/**
 * WebService para realizar el update del token de los dispositivos que coincidan los criterios
 * @param string $lastToken
 * @param string $IMEI
 * @param string $newToken
 * @return string
 */
function UpdateDeviceGCMToken($lastToken, $IMEI, $newToken)
{
    $response = new WSResponse();
    $successResult = DeviceManager::updateDeviceGCMToken($lastToken, $IMEI, $newToken);
    if(!$successResult)
    {
        $response->addError(new WSValidationResult("InvalidDeviceException","El token anterior y el IMEI no coinciden con ningun dispositivo registrado!"));
    }
    $response->setResponse($successResult);
    return json_encode($response->JsonSerialize());
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);