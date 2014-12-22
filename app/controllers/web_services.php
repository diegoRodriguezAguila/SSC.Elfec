<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 12/22/14
 * Time: 4:39 PM
 */
namespace controllers;
use core\view;



class web_services extends \core\controller {

    public function testeo() {
        View::render('../web_services/testeo');
    }
    public function testeowsdl() {
        View::render('../web_services/testeo?wsdl');
    }
} 