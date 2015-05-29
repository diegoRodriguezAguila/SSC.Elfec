<?php
/**
 * Created by PhpStorm.
 * User: drodriguez
 * Date: 27-05-15
 * Time: 11:23 AM
 */

namespace controllers;
use business_logic\OutageCasesManager;
class outage_case extends \core\controller{

    public function getAllExecutingOutageCases()
    {
        header('Content-Type: application/json');
        echo json_encode(OutageCasesManager::getAllOutageCases());
    }
} 