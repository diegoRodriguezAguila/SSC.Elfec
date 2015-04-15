<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 3/10/15
 * Time: 9:31 PM
 */

namespace data_access;


interface ISessionDAL {
       public function testConnection($username, $password);
} 