<?php
/**
 * Created by Diego
 * Date: 13-01-15
 * Time: 08:54 AM
 */

include_once("lib/nusoap.php");
include_once("auto_load.php");
use data_access\LocationPointDALFactory, models\web_services\WSResponse;

$server = new soap_server();
$server->configureWSDL('ssc_elfec', 'urn:ssc_elfec');


$server->register('GetAllLocationPoints',[],
    ['Response' => 'xsd:string'],
    'xsd:ssc_elfec');
function GetAllLocationPoints()
{
    $response = new WSResponse();
    $pointDAL = LocationPointDALFactory::instance();
    $response->setResponse($pointDAL->GetAllLocations());
    return json_encode($response->JsonSerialize());
}


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
