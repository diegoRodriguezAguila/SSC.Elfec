<?php namespace controllers;
use core\view;
use data_access\AccountDALFactory;
use data_access\ClientDALFactory;
use business_logic\gcm_services\GCMAccountManager;
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
        $userDAL = ClientDALFactory::instance();
        /*$newUser = $userDAL->RegisterUser(Client::create()->setGmail('diroag2@gmail.com'));
        $data['welcome_message'] = 'usuario registrado con email: '.$newUser->getGmail().' y id: '.$newUser->getId();*/
        $clientId =  $userDAL->GetClientId('ssc.elfec@gmail.com');
        $a=array();
        $b=new LocationPoint();
        $b->setAddress("asd");
        $b->setInstitutionName("Elfec Sacaba");
        $b->setLatitude( -17.4058059);
        $b->setLongitude(-66.0444019);
        $b->setEndAttention(1);
        $b->setInsertDate(1);
        $b->setPhone(1);
        $b->setStartAttention(1);

        $b->setPhone(1);
        $b->setStatus(1);
        array_push($a,$b);

        $data['welcome_message'] = 'CLIENT ID: '.GCMLocationPointManager::propagatePointsToAllDevices($a);
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
