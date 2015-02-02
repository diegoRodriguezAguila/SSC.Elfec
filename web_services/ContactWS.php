<?php
/**
 * Created by Diego
 * Date: 28-01-15
 * Time: 11:05 AM
 */

include_once("lib/nusoap.php");
include_once("auto_load.php");

use data_access\ContactDALFactory, models\web_services\WSResponse;

$server = new soap_server();
$server->configureWSDL('ssc_elfec', 'urn:ssc_elfec');


$server->register('GetContactUpdate',
    array(),
    array('Response' => 'xsd:string'),
    'xsd:ssc_elfec');

function GetContactUpdate()
{
    $contactDAL = ContactDALFactory::instance();
    $response = new WSResponse();
    $response->setResponse($contactDAL->GetCurrentActiveContact()->jsonSerialize());
    return json_encode($response->JsonSerialize());
}


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);