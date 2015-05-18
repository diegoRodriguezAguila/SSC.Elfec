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
    CONST V_ACCOUNT_INFO = "V_INFO_CUENTA";
    /**
     * Obtiene la información de una cuenta que coincida con el nus y el número de cuenta indicado
     * @param $NUS
     * @param $accountNumber
     * @param $tableToFind
     * @return array
     */
    public static function findAccountData($NUS, $accountNumber, $tableToFind)
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
        $result  = $db->select("SELECT count(1) HAS_TO_SEND_NOTIFICATION FROM dual
                                WHERE CORTES.VALIDA_VENCIDAS(:nus)>1
                                AND ELFEC_SSC.TIENE_VENCIDA_EN_FECHA(:nus, TO_DATE('30-12-2014'))>0 ",
                            [":nus"=>$NUS]);
        return count($result)>0?$result[0]->HAS_TO_SEND_NOTIFICATION>0:false;
    }

} 