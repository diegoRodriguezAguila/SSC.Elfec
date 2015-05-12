<?php namespace controllers;
use business_logic\AccountManager;
use business_logic\ClientManager;
use business_logic\gcm_services\GCMOutageManager;
use core\view;
use data_access\AccountDALFactory;
use data_access\ClientDALFactory;
use business_logic\gcm_services\GCMAccountManager;
use helpers\database;
use models\enums\DataBaseType;
use business_logic\gcm_services\GCMLocationPointManager;
use models\Client;
use models\LocationPoint;
use business_logic\SessionManager;
use business_logic\LocationManager;
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
    public function notification()
    {
        $location=$_POST['location'];
        $message=$_POST['messagge'];
        $accounts=AccountDALFactory::instance();
        $affected_accounts=$accounts->getAll();
        $owners=ClientManager::getOwners($affected_accounts);
        foreach($owners as $owner)
        {
            GCMOutageManager::sendIncidentalOutageNotification($owner->gmail,$message);
        }
        \helpers\url::redirect('welcome?right=true');
    }
    public function programmed_notification()
    {
        //get $notifications
        for($i=0;$i<1/*$notifications*/;$i++)
            //$notifications[i].location $notification[i].message
        GCMOutageManager::sendOutageNotification(1,"random");
        echo "Mensaje enviado!";
    }
	/**
	 * Define Index page title and load template files
	 */
	public function index() {
        if(SessionManager::isLoggedIn())
        {
        $data['title'] = "Bienvenido";
        $data['welcome_message'] = "Ingreso al sistema satisfactorio!";
        $data['locations']=LocationManager::getLocations();
      	View::rendertemplate('header', $data);
		View::render('welcome/welcome', $data);
		View::rendertemplate('footer', $data);
        }
        else
            \helpers\url::redirect('');
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
