<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 3/10/15
 * Time: 9:28 PM
 */

namespace business_logic;
use helpers\Session;

class SessionManager {

    public static function isLoggedIn()
    {
        return Session::get('username')!=null;
    }
    public static function logInUser($username)
    {
        Session::set("username",$username);
    }
    public static function destroySession()
    {
        Session::destroy();
    }
} 