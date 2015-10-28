<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 4/16/15
 * Time: 10:08 PM
 */

namespace business_logic;
use data_access\NotificationDALFactory;
use external_data_access\centrality\OutageCasesEDAL,
    helpers\OracleToString,
    data_access\AccountDALFactory;
/**
 * Class OutageCasesManager
 * Se encarga de los casos de cortes registrados en centrality
 * @package business_logic
 */
class OutageCasesManager {

    /**
     * Obtiene todos los casos de cortes registrados
     * @return array
     */
    public static function getAllOutageCases()
    {
        $outage_cases = OutageCasesEDAL::getAllExecutingOutageCases();
        foreach ($outage_cases as $outage_case)
        {
            $outage_case->sent_notifications = self::getOutageCaseNotifications($outage_case->caso);
        }
        return $outage_cases;
    }

    /**
     * Obtiene las cuentas que son parte de un numero de caso de corte
     * @param $outageCase
     * @return array
     */
    public static function getOutageCaseAccounts($outageCase)
    {
        $outageCaseAccounts = OutageCasesEDAL::getOutageCaseAccounts($outageCase);
        $accountINFilter = OracleToString::convertToSQL(($outageCaseAccounts),"nus");
        return $accounts = AccountDALFactory::instance()->findAccountsINClause($accountINFilter);
    }

    /**
     * Obtiene un  caso de corte según su numero de caso
     * @param $outageCase , El numero de caso
     * @return array , null en caso de que no se haya encontrado un caso con el numero provisto
     */
    public static function getOutageCase($outageCase)
    {
        $result = OutageCasesEDAL::findOutageCase($outageCase);
        if (count($result)>0)
            return $result[0];
        return null;
    }

    /**
     * Obtiene las notificaciones enviadas de un caso específico
     * @param $outageCase , El numero de caso
     * @return array , null en caso de que no se haya encontrado un caso con el numero provisto
     */
    public static function getOutageCaseNotifications($outageCase)
    {
        return NotificationDALFactory::instance()->getOutageCaseNotifications($outageCase);
    }

} 