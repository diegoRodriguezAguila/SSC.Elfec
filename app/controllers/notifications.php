<?php
/**
 * Created by drodriguez
 * Date: 15-05-15
 * Time: 03:13 PM
 */

namespace controllers;
use helpers\OracleToString;
use business_logic\ClientManager;
use business_logic\AccountManager;
use business_logic\gcm_services\GCMOutageManager;

class Notifications extends \core\controller{


    /**
     * Notifica de una notificación de corte fortuito o programado
     */
    public function notification()
    {
        header('Content-Type: application/json');
        if(isset($_POST['message']) && isset($_POST['outage_case']) && isset($_POST['type']))
        {
            $message=$_POST['message'];
            $outage_case = $_POST['outage_case'];
            $type =  $_POST['type'];
            exit ('{ "message": "'.$message.'", "case": "'.$outage_case.'", "type": "'.$type.'"}');
            /*$accounts=AccountDALFactory::instance();
            $affected_accounts=$accounts->getAll();
            $formated_accounts=OracleToString::convertToSQL(($affected_accounts),"nus");
            $owners=ClientManager::getOwners($formated_accounts);
            foreach($owners as $owner)
            {
                GCMOutageManager::sendIncidentalOutageNotification($owner->gmail,$message);
            }*/
        }
        else http_response_code(400);
    }

    /**
     * Envia notificaciones a todos los suminsitros que tengan deudas y sean pasibles a corte desde el día siguiente
     */
    public function nonpayment_outage()
    {
        $nonpayment_accounts= AccountManager::getNonPaymentOutageAccounts();
        foreach($nonpayment_accounts as $account)
        {
            GCMOutageManager::sendNonPaymentOutageNotification($account);
        }
        \helpers\url::redirect('welcome?right=true');
    }
} 