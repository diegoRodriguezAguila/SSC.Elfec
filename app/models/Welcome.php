<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 12/17/14
 * Time: 4:40 PM
 */

namespace models;


class Welcome extends \core\model {

    protected $_db;

    public function __construct(){
        //connect to PDO here.
        $this->_db = \helpers\database::get();


    }
    public function getSomething($id)
    {
      //  $result = $this->_db->select('SELECT * FROM test');
        //return $result;
        return 0;
    }
}

