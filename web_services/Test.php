<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 12/17/14
 * Time: 7:11 PM
 */

namespace web_services;
include_once('lib/nusoap.php');


class Test {
    public function  __construct()
    {
        $server = new soap_server();
        $server->configureWSDL('demo', 'urn:demo');



        $server->register('estapunto',
            array('x' => 'xsd:string','y' => 'xsd:string','gid' => 'xsd:string'),
            array('resp' => 'xsd:string'),
            'xsd:demo');
        $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
            ? $HTTP_RAW_POST_DATA : '';
        $server->service($HTTP_RAW_POST_DATA);

    }

    function estapunto($x,$y,$gid)
    {
        return "tu vieja";
    }
} 