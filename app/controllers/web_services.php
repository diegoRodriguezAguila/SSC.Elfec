<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 22-12-14
 * Time: 03:49 PM
 */

namespace controllers;
use core\view;

class web_services extends \core\controller{

    public function __construct(){
        parent::__construct();
    }

    public function testeo() {
        View::render('../web_services/testeo');
    }
} 