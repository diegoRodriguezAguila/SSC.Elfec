<?php namespace controllers;
use business_logic\ClientManager;
use core\view;
use data_access\AccountDALFactory;
use data_access\ClientDALFactory;
use business_logic\gcm_services\GCMAccountManager;
use helpers\database;
use models\enums\DataBaseType;
use business_logic\gcm_services\GCMLocationPointManager;
use models\Client;
use models\LocationPoint;

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
        $data['title'] = $this->language->get('welcome_text');
        $data['welcome_message'] = $this->language->get('welcome_message');
        $data['welcome_message'] = '<B>RESULT</B>: '.ClientManager::getAllAccounts("ssc.elfec@gmail.com");
		View::rendertemplate('header', $data);
		View::render('welcome/welcome', $data);
		View::rendertemplate('footer', $data);
	}

	/**
	 * Define Subpage page title and load template files
	 */
	public function subpage() {
		$data['title'] = $this->language->get('subpage_text');
		$data['welcome_message'] = $this->language->get('subpage_message');
		
		View::rendertemplate('header', $data);
		View::render('welcome/subpage', $data);
		View::rendertemplate('footer', $data);
	}

    public function funcion() {
        View::render('../web_services/testeo');
    }

}
