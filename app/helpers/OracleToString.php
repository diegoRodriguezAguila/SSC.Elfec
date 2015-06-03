<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 5/13/15
 * Time: 10:32 PM
 */

namespace helpers;

define('IN_LIMIT',1000);
class OracleToString {


    public function __construct()
    {

    }
    /**
     * Convierte la lista de objetos a la cadena utilizable en una consulta IN tomando en
     * cuenta el limite de <b>IN_LIMIT</b> valores en cada IN, debe utilizarse para cantidades de objetos superiores a <b>IN_LIMIT</b>
     * @param objectList
     * @param columnName , el nombre de la columna en la base de datos
     * @return array con el formato (123,425,...) OR COLUMNNAME IN (423,645,...)
     */
    public static function convertToSQL($objectList,$columnName)
    {
        $query = " IN (";
        $totalSize = count($objectList);
        $count = intval($totalSize/IN_LIMIT);
        for ($i = 0; $i <= $count; $i++) {
            if($totalSize>IN_LIMIT)
                $limit=IN_LIMIT;
            else
                $limit=$totalSize;
            $totalSize-=$limit;
            for($j=0;$j<$limit;$j++)
            {
                $query.=("'".($objectList[$j+($i*(IN_LIMIT))]->$columnName))."'";
                if($j<($limit-1))
                    $query.=",";
            }
            $query.=") ";
            if($i<$count && $limit>0)
            {
                $query=$query." OR IN(";
            }
        }
        return $query;
    }
} 