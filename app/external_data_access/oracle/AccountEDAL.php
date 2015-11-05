<?php
/**
 * Created by Diego
 * Date: 10-02-15
 * Time: 03:36 PM
 */

namespace external_data_access\oracle;

use helpers\database;
use models\enums\DataBaseType;
/**
 * Class AccountDataReader Se encarga de la lectura de datos de cuentas la
 * base de datos Oracle
 * @package external_data_access\oracle
 */
class AccountEDAL {

    const V_ACCOUNT_VALIDATION = "V_VALIDACION_CUENTA";
    const V_ACCOUNT_INFO = "V_INFO_CUENTA";
    /**
     * Obtiene la información de una cuenta que coincida con el nus indicado
     * @param $NUS
     * @param $tableToFind
     * @return array
     */
    public static function findAccountData($NUS, $tableToFind)
    {
        $db = database::get(DataBaseType::$ORACLE_DATABASE);
        $result  = $db->select("SELECT /*+CHOOSE*/ * FROM ELFEC_SSC.".$tableToFind." WHERE IDSUMINISTRO=:nus",
        [":nus"=>$NUS]);
        return $result;
    }

    /**
     * Obtiene la información de una cuenta que coincida con el nus y el número de cuenta indicado
     * @param $NUS
     * @param $accountNumber
     * @param $tableToFind
     * @return array
     */
    public static function findAccount($NUS, $accountNumber, $tableToFind)
    {
        $db = database::get(DataBaseType::$ORACLE_DATABASE);
        $result  = $db->select("SELECT /*+CHOOSE*/ * FROM ELFEC_SSC.".$tableToFind." WHERE IDSUMINISTRO=:nus AND NROSUM=:accountNumber",
            [":nus"=>$NUS, ":accountNumber"=>$accountNumber]);
        return $result;
    }

    /**
     * Obtiene la evolucion de los consumos dado un NUS
     * @param $NUS
     * @return array
     */
    public static function getUsageFromAccount($NUS)
    {
        $db = database::get(DataBaseType::$ORACLE_DATABASE);
        $result  = $db->select("SELECT /*+CHOOSE*/ GESTION, CONSUMO from table(select ELFEC_SSC.F_CONSUMOS (:nus) FROM DUAL)",
            [":nus"=>$NUS]);
        return $result;
    }

    /**
     * Verifica si es que a una cuenta se le debe enviar una notificación
     * por falta de pago
     * @param $NUS
     * @return bool
     */
    public static function isNonPaymentOutageAccount($NUS)
    {
        $db = database::get(DataBaseType::$ORACLE_DATABASE);
        // producción: SYSDATE CUENTA_VENCIDAS y SYSDATE-1 TIENE_VENCIDA_EN_FECHA
        $result  = $db->select("SELECT count(1) HAS_TO_SEND_NOTIFICATION FROM dual
                                WHERE ELFEC_SSC.CUENTA_VENCIDAS(:nus, SYSDATE)>=2
                                AND ELFEC_SSC.TIENE_VENCIDA_EN_FECHA(:nus, SYSDATE-1)>0",
                            [":nus"=>$NUS]);
        return count($result)>0?$result[0]->HAS_TO_SEND_NOTIFICATION>0:false;
    }

    /**
     * Verifica si es que una cuenta tiene una factura que vence el dia de hoy
     * por falta de pago
     * @param $NUS
     * @return bool
     */
    public static function hasJustExpiredDebt($NUS)
    {
        $db = database::get(DataBaseType::$ORACLE_DATABASE);
        // producción: SYSDATE TIENE_VENCIDA_EN_FECHA
        $result  = $db->select("SELECT count(1) HAS_TO_SEND_NOTIFICATION FROM dual
                                WHERE ELFEC_SSC.TIENE_VENCIDA_EN_FECHA(:nus, SYSDATE)>0",
            [":nus"=>$NUS]);
        return count($result)>0?$result[0]->HAS_TO_SEND_NOTIFICATION>0:false;
    }


    /**
     * Obtiene la cadena del periodo de la factura que vence el dia de hoy
     * @param $NUS
     * @return string
     */
    public static function getJustExpiredDebtPeriod($NUS)
    {
        $db = database::get(DataBaseType::$ORACLE_DATABASE);
        // producción: SYSDATE PERIODO_VENCIDA_EN_FECHA
        $result  = $db->select("SELECT ELFEC_SSC.PERIODO_VENCIDA_EN_FECHA(:nus, SYSDATE) PERIODS FROM dual",
            [":nus"=>$NUS]);
        return count($result)>0?$result[0]->PERIODS:null;
    }

    /**
     * Obtiene la cadena de los periodos de facturas vencidas hasta la fecha actual de una cuenta
     * @param $NUS
     * @return string
     */
    public static function getPeriodsOfAllExpiredDebts($NUS)
    {
        $db = database::get(DataBaseType::$ORACLE_DATABASE);
        // producción: SYSDATE PERIODOS_VENCIDAS
        $result  = $db->select("SELECT ELFEC_SSC.PERIODOS_VENCIDAS(:nus, SYSDATE) PERIODS FROM dual",
            [":nus"=>$NUS]);
        return count($result)>0?$result[0]->PERIODS:null;
    }

} 