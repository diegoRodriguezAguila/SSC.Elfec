<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 1/2/15
 * Time: 11:47 AM
 */

namespace data_access\pgsql;

use data_access\Client;
use data_access\IPayPointDAL;
use helpers\Database;
use models\PayPoint;
class PayPointDal implements IPayPointDAL {
    /**
     * Retorna las ubicaciones de todas las sucursales.
     * @return string
     */
    public function GetAllLocations()
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM pay_points");
        return $result;
    }

} 