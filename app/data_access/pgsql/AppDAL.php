<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 09-06-15
 * Time: 04:57 PM
 */

namespace data_access\pgsql;


use data_access\IAppDAL;
use helpers\Database;

class AppDAL implements IAppDAL {
    /**
     * Obtiene la ultima información de la aplicación válida
     * @return array|null
     */
    public function getLastAppInfo(){
        $db = Database::get();
        $result  = $db->select("SELECT * FROM application WHERE status=1 ORDER BY id DESC LIMIT 1");
        return count($result)>0?$result[0]:null;
    }

    /**
     * Obtiene todas las información de la aplicación válidas
     * @return array|null
     */
    public function getAllValidAppInfos(){
        $db = Database::get();
        return $db->select("SELECT * FROM application WHERE status=1 ORDER BY id DESC");
    }
} 