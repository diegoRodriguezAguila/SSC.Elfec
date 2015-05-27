<?php
/**
 * Created by Diego
 * Date: 10-02-15
 * Time: 02:19 PM
 */

namespace models\enums;

/**
 * Class DataBaseType Enumera las distintas configuraciones para conexión a base de datos
 * @package models\enums
 */
class DataBaseType {

    /**
     * Constante que se usa como confiración por defecto para conectar
     * a PGSQL
     * @var array
     */
    public static $PGSQL_DATABASE = ['type' => DB_TYPE,
        'host' => DB_HOST,
        'port' => DB_PORT,
        'name' => DB_NAME,
        'user' => DB_USER,
        'pass' => DB_PASS];

    /**
     * Constante para usar como configuraciòn de oraculo
     * @var array
     */
    public static $ORACLE_DATABASE = ['type' => ODB_TYPE,
        'host' => ODB_HOST,
        'port' => ODB_PORT,
        'name' => ODB_NAME,
        'user' => ODB_USER,
        'pass' => ODB_PASS];

    /**
     * Constante para usar como configuraciòn de centrality
     * @var array
     */
    public static $CENTRALITY_DATABASE = ['type' => CENTRALITY_DB_TYPE,
        'host' => CENTRALITY_DB_HOST,
        'port' => CENTRALITY_DB_PORT,
        'name' => CENTRALITY_DB_NAME,
        'user' => CENTRALITY_DB_USER,
        'pass' => CENTRALITY_DB_PASS];
} 