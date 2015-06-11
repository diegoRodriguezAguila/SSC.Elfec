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
    business_logic\WSSecurity,
    models\web_services\WSValidationResult;


$server = new soap_server();
$server->configureWSDL('ssc_elfec', 'urn:ssc_elfec');


$server->register('UpdateDeviceGCMToken',
    ['LastToken' => 'xsd:string','IMEI' => 'xsd:string', 'NewToken' => 'xsd:string'],
    ['Response' => 'xsd:string'],'xsd:ssc_elfec');
/**
 * WebService para realizar el update del token de los dispositivos que coincidan los criterios
 * @param string $LastToken
 * @param string $IMEI
 * @param string $NewToken
 * @return string
 */
function UpdateDeviceGCMToken($LastToken, $IMEI, $NewToken)
{
    WSSecurity::verifyAuthenticity();
    $response = new WSResponse();
    $successResult = DeviceManager::updateDeviceGCMToken($LastToken, $IMEI, $NewToken);
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