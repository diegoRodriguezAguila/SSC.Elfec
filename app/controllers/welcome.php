<?php namespace controllers;
use core\view;
use business_logic\SessionManager;
/*
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
class Welcome extends \core\controller{

	/**
	 * Call the parent construct
	 */
	public function __construct(){
		parent::__construct();

		$this->language->load('welcome');
	}

	/**
	 * Define Index page title and load template files
	 */
	public function index() {
        if(SessionManager::isLoggedIn())
        {
            $data['title'] = "Envío de notificaciones";
            $data['welcome_message'] = "Ingreso al sistema satisfactorio!";
            $data['angular_controllers'] = ['outage_cases_controller.js'];
            $data['angular_services'] = ['outage_cases.js', 'notifications.js'];
            View::rendertemplate('header', $data);
            View::render('welcome/welcome', $data);
            View::rendertemplate('footer', $data);
        }
        else
            \helpers\url::redirect('');
	}

}
