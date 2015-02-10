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
class AccountDataReader {

    /**
     * Obtiene la información de una cuenta que coincida con el nus y el número de cuenta indicado
     * @param $NUS
     * @param $accountNumber
     * @return array
     */
    public static function findAccountCoincidence($NUS, $accountNumber)
    {
        $db = database::get(DataBaseType::$ORACLE_DATABASE);
        $result  = $db->select("SELECT * FROM ELFEC_SSC.V_VALIDACION_CUENTA WHERE ROWNUM=1 AND IDSUMINISTRO=:nus AND NROSUM=:accountNumber",
        [":nus"=>$NUS, ":accountNumber"=>$accountNumber]);
        return $result;
    }
} 