<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 3/10/15
 * Time: 9:32 PM
 */

namespace data_access\pgsql;
use helpers\Database;
use data_access\ISessionDAL;

class SessionDAL implements ISessionDAL{
    public function testConnection($username, $password)
    {
        $group =  array (
            'type' => DB_TYPE,
            'host' => DB_HOST,
            'port' => DB_PORT,
            'name' => DB_NAME,
            'user' => $username,
            'pass' => $password
        );
        try
        {
            Database::get($group);
        }
        catch(\PDOException $ex)
        {
            return false;
        }
        return true;
    }

} 