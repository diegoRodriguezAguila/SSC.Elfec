<?php
/**
 * Created by Diego
 * Date: 22-12-14
 * Time: 05:17 PM
 */

include_once("lib/nusoap.php");
require_once ("../app/data_access/AbstractFactory.php");
require_once ("../app/data_access/ClientDALFactory.php");
$server = new soap_server();
$server->configureWSDL('ssc_elfec', 'urn:ssc_elfec');



$server->register('RegisterAccount',
    array('AccountNumber' => 'xsd:string','NUS' => 'xsd:int', 'GMail' => 'xsd:string', 'PhoneNumber' => 'xsd:string', 'DeviceBrand' => 'xsd:string', 'DeviceModel' => 'xsd:string'
    , 'DeviceIMEI' => 'xsd:string'),
    array('Response' => 'xsd:integer'),
    'xsd:ssc_elfec');

/**
 *  Método de servicio web para el registro de una cuenta y su asociación con un usuario, un dispositivo y un numero de teléfono
 * @param $AccountNumber
 * @param $NUS
 * @param $GMail
 * @param $PhoneNumber
 * @param $DeviceBrand
 * @param $DeviceModel
 * @param $DeviceIMEI
 * @return int
 */
function RegisterAccount($AccountNumber, $NUS, $GMail, $PhoneNumber, $DeviceBrand, $DeviceModel, $DeviceIMEI)
{
    $clientDAL = ClientDALFactory::instance();
    /* $clientId =  $clientDAL->GetClientId($GMail);
     if($clientId==-1)
     {
         $clientId = $clientDAL->RegisterClient(Client::create()->setGmail($GMail));
     }*/
    return 2;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);