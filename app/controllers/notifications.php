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
        foreach($nonpayment_accounts as $account)
        {
            GCMOutageManager::sendNonPaymentOutageNotification($account);
        }
        \helpers\url::redirect('welcome?right=true');
    }
} 