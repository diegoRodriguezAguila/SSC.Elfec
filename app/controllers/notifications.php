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
    public function nonpayment_outage()
    {
        $nonpayment_accounts= AccountManager::getNonPaymentOutageAccounts();
        var_dump($nonpayment_accounts);
        $formatted_accounts=OracleToString::convertToSQL(($nonpayment_accounts), "nus");
        $owners=ClientManager::getOwners($formatted_accounts);
        foreach($owners as $owner)
        {
            GCMOutageManager::sendNonPaymentOutageNotification($owner->gmail);
        }
        //\helpers\url::redirect('welcome?right=true');
    }
} 