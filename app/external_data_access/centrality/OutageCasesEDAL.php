<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 27-05-15
 * Time: 09:59 AM
 */

namespace external_data_access\centrality;
use helpers\database;
use models\enums\DataBaseType;
/**
 * Class OutageCasesEDAL
 * Se encarga de la lectura de los casos de cortes de centrality
 * @package external_data_access\centrality
 */
class OutageCasesEDAL {
    /**
     * Obtiene todos los casos de cortes que se están ejecutando actualmente
     * @return array
     */
    public static function getAllExecutingOutageCases()
    {
        $db = database::get(DataBaseType::$CENTRALITY_DATABASE);
        $result  = $db->select("SELECT  caso, tipo_corte, descripcion, count(nus) suministros_afectados,
                                to_char(fecha_inicio, 'YYYY-MM-DD HH24:MI:SS') fecha_inicio, to_char(fecha_fin, 'YYYY-MM-DD HH24:MI:SS') fecha_fin
                                FROM ssc.ssc_cliente_interrumpido
                                GROUP BY caso,tipo_corte, descripcion, fecha_inicio, fecha_fin
                                ORDER BY tipo_corte, caso");
        return $result;
    }

    /**
     * Obtiene el resto de información de un numero de caso
     * @param $outageCase
     * @return array
     */
    public static function findOutageCase($outageCase)
    {
        $db = database::get(DataBaseType::$CENTRALITY_DATABASE);
        $result  = $db->select("SELECT  caso, tipo_corte, descripcion, count(nus) suministros_afectados,
                                to_char(fecha_inicio, 'YYYY-MM-DD HH24:MI:SS') fecha_inicio, to_char(fecha_fin, 'YYYY-MM-DD HH24:MI:SS') fecha_fin
                                FROM ssc.ssc_cliente_interrumpido
                                WHERE caso = :caso
                                GROUP BY caso,tipo_corte, descripcion, fecha_inicio, fecha_fin
                                ORDER BY tipo_corte, caso
                                LIMIT 1", [':caso'=>$outageCase]);
        return $result;
    }

    public static function getOutageCaseAccounts($outageCase)
    {
        $db = database::get(DataBaseType::$CENTRALITY_DATABASE);
        $result  = $db->select("SELECT  caso, tipo_corte, descripcion, nus,
                                to_char(fecha_inicio, 'YYYY-MM-DD HH24:MI:SS') fecha_inicio, to_char(fecha_fin, 'YYYY-MM-DD HH24:MI:SS') fecha_fin
                                FROM ssc.ssc_cliente_interrumpido
                                WHERE caso= :caso", [':caso'=>$outageCase]);
        return $result;
    }

} 