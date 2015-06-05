<?php namespace controllers;
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 3/9/15
 * Time: 9:18 PM
 */
use core\View;
use data_access\SessionDALFactory;
use business_logic\SessionManager;
class session extends \core\controller {
    public function __construct(){
        parent::__construct();
        $this->language->load('welcome');
    }
    public function login()
    {
        if(SessionManager::isLoggedIn())
            \helpers\url::redirect('welcome');
        else
        {
            $data['title'] = "Inicio de sesion";
            View::rendertemplate('header', $data);
            View::render('session/login', $data);
            View::rendertemplate('footer', $data);
        }
    }
    public function logout()
    {
        SessionManager::logOut();
        \helpers\url::redirect('');
    }
    public function auth_user()
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $session=SessionDALFactory::instance();
        if($session->testConnection($username,$password))
        {
            SessionManager::logInUser($username, $password);
            \helpers\url::redirect('welcome');
        }
        else
        {
            \helpers\url::redirect('?error');
        }
    }

} 