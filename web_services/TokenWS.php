<?php
/**
 * Created by Diego
 * Date: 09-06-15
 * Time: 11:05 AM
 */

include_once("lib/nusoap.php");
include_once("auto_load.php");

use business_logic\TokenManager,
    models\web_services\WSResponse;

$server = new soap_server();
$server->configureWSDL('ssc_elfec', 'urn:ssc_elfec');


$server->register('RequestToken',
    ['IMEI' => 'xsd:string', 'Signature' => 'xsd:string',
        'Salt' => 'xsd:string', 'VersionCode' => 'xsd:int'],
    ['Response' => 'xsd:string'],
    'xsd:ssc_elfec');
/**
 * Realiza la solicitud d eun token
 * @param $IMEI string
 * @param $Signature string
 * @param $Salt string
 * @param $VersionCode integer
 * @return string
 */
function RequestToken($IMEI, $Signature, $Salt, $VersionCode)
{
    $response = new WSResponse();
    if (TokenManager::areCredentialsValid($Signature, $Salt, $VersionCode)) {
        $response->setResponse(TokenManager::generateToken($IMEI, $Signature, $Salt, $VersionCode)->jsonSerialize());
    }
    else die(http_response_code(403)); //invalid credentials
    return json_encode($response->jsonSerialize());
}


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);