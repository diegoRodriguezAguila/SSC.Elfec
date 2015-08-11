<?php
/**
 * Created by Diego
 * Date: 22-12-14
 * Time: 05:17 PM
 */


include_once("lib/nusoap.php");
include_once("auto_load.php");
use business_logic\ClientManager;
use business_logic\gcm_services\GCMAccountManager;
use business_logic\WSSecurity,
    models\web_services\WSResponse,
    models\web_services\WSValidationResult,
    data_access\ClientDALFactory,
    data_access\AccountDALFactory,
    business_logic\AccountManager;

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
    WSSecurity::verifyAuthenticity();
    $response = new WSResponse();
    $registeredAccount = null;
    $clientId =  ClientManager::addClient($GMail);
    if(AccountManager::isAValidAccount($NUS, $AccountNumber))
    {
        $nus = ClientManager::addAccountToClient($NUS, $clientId);
        ClientManager::addPhoneNumberToClient($PhoneNumber, $clientId);
        ClientManager::addDeviceToClient($DeviceIMEI, $GCM, $DeviceBrand, $DeviceModel, $clientId);
        $registeredAccount = AccountManager::getFullAccountData($nus);
        GCMAccountManager::propagateNewAccountToDevices($GMail,$registeredAccount,$DeviceIMEI);
    }
    else
    {
        $response->addError(new WSValidationResult("InvalidAccountException","El NUS y el número de cuenta proporcionados no coinciden con ninguna cuenta válida, revise los datos y vuelva a intentarlo"));
    }
    $response->setResponse(isset($registeredAccount)?$registeredAccount->jsonSerialize():null);
    return json_encode($response->JsonSerialize());
}

$server->register('GetAllAccounts',
    array('GMail' => 'xsd:string', 'DeviceBrand' => 'xsd:string', 'DeviceModel' => 'xsd:string'
    , 'DeviceIMEI' => 'xsd:string','GCM' => 'xsd:string'),
    array('Response' => 'xsd:string'),
    'xsd:ssc_elfec');

function GetAllAccounts($GMail, $DeviceBrand, $DeviceModel, $DeviceIMEI,$GCM)
{
    WSSecurity::verifyAuthenticity();
    $clientId =  ClientManager::addClient($GMail);
    ClientManager::addDeviceToClient($DeviceIMEI, $GCM, $DeviceBrand, $DeviceModel, $clientId);
    $response = new WSResponse();
    $accounts=ClientManager::getAllAccounts($GMail);

    $response->setResponse($accounts);

    return json_encode($response->JsonSerialize());
}


$server->register('GetUsage',
    array('NUS' => 'xsd:string'),
    array('Response' => 'xsd:string'),
    'xsd:ssc_elfec');

function GetUsage($NUS)
{
    WSSecurity::verifyAuthenticity();
    $response = new WSResponse();
    $response->setResponse(json_encode(AccountManager::getUsageFromAccount($NUS)));
   return json_encode($response->JsonSerialize());
}


$server->register('DeleteAccount',   array('DeviceIMEI' => 'xsd:string','NUS' => 'xsd:string', 'GMail' => 'xsd:string'),
    array('Response' => 'xsd:integer'),
    'xsd:ssc_elfec');
function DeleteAccount($DeviceIMEI,$NUS,$GMail)
{
    WSSecurity::verifyAuthenticity();
    $response = new WSResponse();
    $clientDAL = ClientDALFactory::instance();
    $clientId =  $clientDAL->GetClientId($GMail);
    if($clientId==-1)
    {
        $response->addError(new WSValidationResult("ClientPermissionDenied","Usted no tiene permisos necesarios para realizar esta accion"));
    }
    if(!ClientManager::clientHasDevice($DeviceIMEI,$clientId))
    {
        $response->addError(new WSValidationResult("DevicePermissionDenied","Este dispositivo no tiene permiso para realizar la acción"));
    }
    if(!ClientManager::clientHasAccount($NUS, $clientId))
    {
        $response->addError(new WSValidationResult("AccountPermissionDenied","Usted no tiene registrada la cuenta que esta tratando de eliminar"));
    }
    $errors=count($response->getErrors());
    if($errors>0)
        $response->setResponse(false);
    else
    {
        $accountDAL = AccountDALFactory::instance();
        $accountDAL->DeleteAccount($NUS,$clientId);
        $response->setResponse(true);
        GCMAccountManager::propagateDeletedAccountToDevices($GMail, $NUS, $DeviceIMEI);
    }
    return json_encode($response->JsonSerialize());
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
