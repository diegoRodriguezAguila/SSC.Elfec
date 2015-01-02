<?php
/**
 * Created by Diego
 * Date: 22-12-14
 * Time: 05:17 PM
 */


include_once("lib/nusoap.php");
include_once("auto_load.php");

use  models\Client, models\Account,models\MobilePhone,models\Device,models\PayPoint, data_access\ClientDALFactory, data_access\AccountDALFactory, data_access\MobilePhoneDALFactory,data_access\deviceDALFactory,data_access\PayPointDALFactory;
$server = new soap_server();
$server->configureWSDL('ssc_elfec', 'urn:ssc_elfec');


$server->register('RegisterAccount',
    array('AccountNumber' => 'xsd:string','NUS' => 'xsd:int', 'GMail' => 'xsd:string', 'PhoneNumber' => 'xsd:string', 'DeviceBrand' => 'xsd:string', 'DeviceModel' => 'xsd:string'
    , 'DeviceIMEI' => 'xsd:string','GCM' => 'xsd:string'),
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
 * @param $GCM
 * @return int
 */
function RegisterAccount($AccountNumber, $NUS, $GMail, $PhoneNumber, $DeviceBrand, $DeviceModel, $DeviceIMEI,$GCM)
{
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

    /*if(!$clientDAL->HasDevice($GCM, $DeviceIMEI))
    {
        Lo hago luego me dio flojera xD
    }*/
    return $clientId;
}
$server->register('GetAllAccounts',
    array('ClientId' => 'xsd:integer'),
    array('Response' => 'xsd:string'),
    'xsd:ssc_elfec');
function GetAllAccounts($ClientId)
{
    $clientDAL = ClientDALFactory::instance();
    return json_encode($clientDAL->GetAllAccounts($ClientId));

}
$server->register('GetAllPayPoints',
    array(),
    array('Response' => 'xsd:string'),
    'xsd:ssc_elfec');
function GetAllPayPoints()
{
    $pointDAL = PayPointDALFactory::instance();
    return json_encode($pointDAL->GetAllLocations());

}

$server->register('DeleteAccount',
    array('IMEI' => 'xsd:string','NUS' => 'xsd:int', 'GMail' => 'xsd:string'),
    array('Response' => 'xsd:integer'),
    'xsd:ssc_elfec');
function DeleteAccount($IMEI,$NUS,$GMail)
{
    $clientDAL = ClientDALFactory::instance();
    $clientId =  $clientDAL->GetClientId($GMail);
    if($clientId==-1)
    {
        //esta trucheando correo es un vivillo
        return -1;
    }
    if(!$clientDAL->HasDevice($IMEI,$clientId))
    {
        //es un dispositivo x, no puede borrar
        return -2;
    }
    if(!$clientDAL->HasAccount($GMail, $NUS))
    {
        //No es su cuenta
        return -3;
    }
    $accountDAL = AccountDALFactory::instance();
    $accountDAL->DeleteAccount($NUS,$clientId);
    return 0;
}

//RegisterAccount(12345,54321,'pedro@gmail.com',777777,'Sony','Xperia S','33333333321');

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
