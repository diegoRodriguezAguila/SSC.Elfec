<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 4/16/15
 * Time: 10:08 PM
 */

namespace business_logic;
use external_data_access\centrality\OutageCasesEDAL;
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
        return OutageCasesEDAL::getAllExecutingOutageCases();
    }

} 