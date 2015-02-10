<?php namespace controllers;
use core\view;
use data_access\AccountDALFactory;
use data_access\ClientDALFactory;
use business_logic\gcm_services\GCMAccountManager;
use helpers\database;
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
        $db = database::get(['type' => ODB_TYPE,
            'host' => ODB_HOST,
            'port' => ODB_PORT,
            'name' => ODB_NAME,
            'user' => ODB_USER,
            'pass' => ODB_PASS]);
        $result  = $db->select("SELECT * FROM ELFEC_SSC.V_INFO_CUENTA WHERE ROWNUM <=100");
        //$db = database::get();
       // $result  = $db->select("SELECT * FROM contacts");
        $data['welcome_message'] = '<B>RESULT</B>: '.count($result).json_encode($result);
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
