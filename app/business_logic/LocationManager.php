<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 4/16/15
 * Time: 10:08 PM
 */

namespace business_logic;


class LocationManager {

    public static function getLocations()
    {
        $locations=array();

        array_push($locations,['name'=>'Ubicacion 1','id'=>'1']);

        array_push($locations,['name'=>'Ubicacion 2','id'=>'2']);

        array_push($locations,['name'=>'Ubicacion 3','id'=>'3']);
        return $locations;
    }

} 