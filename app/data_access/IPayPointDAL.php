<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 1/2/15
 * Time: 11:38 AM
 */

namespace data_access;

use models\PayPoint;
interface IPayPointDAL {

    /**
     * Retorna las ubicaciones de todas las sucursales.
     * @return string
     */
    public function GetAllLocations();
} 