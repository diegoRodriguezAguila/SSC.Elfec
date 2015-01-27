<?php
/**
 * Created by Diego
 * Date: 22-12-14
 * Time: 05:17 PM
 */


include_once("lib/nusoap.php");
include_once("auto_load.php");

use  models\Client, models\Account, models\MobilePhone,models\Device, models\web_services\WSResponse,
    models\web_services\WSValidationResult, data_access\ClientDALFactory, data_access\AccountDALFactory,
    data_access\MobilePhoneDALFactory, data_access\deviceDALFactory;
$server = new soap_server();
$server->configureWSDL('ssc_elfec', 'urn:ssc_elfec');


$server->register('RegisterAccount',
    array('AccountNumber' => 'xsd:string','NUS' => 'xsd:int', 'GMail' => 'xsd:string', 'PhoneNumber' => 'xsd:string', 'DeviceBrand' => 'xsd:string', 'DeviceModel' => 'xsd:string'
    , 'DeviceIMEI' => 'xsd:string','GCM' => 'xsd:string'),
    array('Response' => 'xsd:string'),'xsd:ssc_elfec');
/**
 *  Método de servicio web para el registro de una cuenta y su asociación con un usuario, un dispositivo y un numero de teléfono
 * @param $AccountNumber
 * @param $NUS
 * @param $GMail
 * @param $PhoneNumber
 * @param $DeviceBrand
 * @param $DeviceModel
 * @param $DeviceIMEI
 * @param $GCM
 * @return string
 */
function RegisterAccount($AccountNumber, $NUS, $GMail, $PhoneNumber, $DeviceBrand, $DeviceModel, $DeviceIMEI,$GCM)
{
    $response = new WSResponse();
    $registerSuccess = true;
    $clientDAL = ClientDALFactory::instance();
    $clientId =  $clientDAL->GetClientId($GMail);

    if($clientId==-1)
    {
        $clientId = $clientDAL->RegisterClient(Client::create()->setGmail($GMail));
    }
    if(!$clientDAL->HasAccount($GMail, $NUS))
    {
        $accountDAL = AccountDALFactory::instance();
        $accountDAL->RegisterAccount(Account::create()->setClientId($clientId)->setAccountNumber($AccountNumber)->setNUS($NUS));
    }
    if(!$clientDAL->HasPhoneNumber($PhoneNumber,$clientId))
    {
        $phoneDAL = MobilePhoneDALFactory::instance();
        $phoneDAL->RegisterPhone(MobilePhone::create()->setClientId($clientId)->setNumber($PhoneNumber));
    }
    if(!$clientDAL->HasDevice($DeviceIMEI,$clientId))
    {
        $deviceDAL = DeviceDALFactory::instance();
        $deviceDAL->RegisterDevice(Device::create()->setGCMToken($GCM)->setImei($DeviceIMEI)->setClientId($clientId)->setModel($DeviceModel)->setBrand($DeviceBrand));
    }
    $errors=count($response->getErrors());
    if($errors>0)
        $registerSuccess = false;
    $response->setResponse($registerSuccess);
    return json_encode($response->JsonSerialize());
}

$server->register('GetAllAccounts',
    array('GMail' => 'xsd:string', 'DeviceBrand' => 'xsd:string', 'DeviceModel' => 'xsd:string'
    , 'DeviceIMEI' => 'xsd:string','GCM' => 'xsd:string'),
    array('Response' => 'xsd:string'),
    'xsd:ssc_elfec');

function GetAllAccounts($GMail, $DeviceBrand, $DeviceModel, $DeviceIMEI,$GCM)
{
    $clientDAL = ClientDALFactory::instance();
    $clientId =  $clientDAL->GetClientId($GMail);

    if($clientId==-1)
    {
        $clientId = $clientDAL->RegisterClient(Client::create()->setGmail($GMail));
    }
    if(!$clientDAL->HasDevice($DeviceIMEI,$clientId))
    {
        $deviceDAL = DeviceDALFactory::instance();
        $deviceDAL->RegisterDevice(Device::create()->setGCMToken($GCM)->setImei($DeviceIMEI)->setClientId($clientId)->setModel($DeviceModel)->setBrand($DeviceBrand));
    }
    $response = new WSResponse();
    $response->setResponse($clientDAL->GetAllAccounts($GMail));
    return json_encode($response->JsonSerialize());
}

$server->register('DeleteAccount',   array('IMEI' => 'xsd:string','NUS' => 'xsd:string', 'GMail' => 'xsd:string'),
    array('Response' => 'xsd:integer'),
    'xsd:ssc_elfec');
function DeleteAccount($IMEI,$NUS,$GMail)
{
    $response = new WSResponse();
    $clientDAL = ClientDALFactory::instance();
    $clientId =  $clientDAL->GetClientId($GMail);
    if($clientId==-1)
    {
        $response->addError(new WSValidationResult("ClientPermissionDenied","Usted no tiene permisos necesarios para realizar esta accion"));
    }
    if(!$clientDAL->HasDevice($IMEI,$clientId))
    {
        $response->addError(new WSValidationResult("DevicePermissionDenied","Este dispositivo no se encuentra registrado"));
    }
    if(!$clientDAL->HasAccount($GMail, $NUS))
    {
        $response->addError(new WSValidationResult("AccountPermissionDenied","La cuenta que esta tratando de eliminar no le pertenece"));
    }
    $errors=count($response->getErrors());
    if($errors>0)
        $response->setResponse(false);
    else
    {
        $accountDAL = AccountDALFactory::instance();
        $accountDAL->DeleteAccount($NUS,$clientId);
        $response->setResponse(true);
    }
    return json_encode($response->JsonSerialize());
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
