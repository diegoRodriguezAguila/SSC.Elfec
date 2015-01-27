<?php namespace core;

/*
 * config - an example for setting up system settings
 * When you are done editing, rename this file to 'config.php'
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @author Edwin Hoksberg - info@edwinhoksberg.nl
 * @version 2.1
 * @date June 27, 2014
 */
class Config {

	public function __construct() {

		//turn on output buffering
		ob_start();

		//site address
		define('DIR', 'http://localhost/SSC.Elfec/');

		//set default controller and method for legacy calls
		define('DEFAULT_CONTROLLER', 'welcome');
		define('DEFAULT_METHOD' , 'index');

		//set a default language
		define('LANGUAGE_CODE', 'en');

        //set the api key from Google API
        define( 'API_ACCESS_KEY', 'AIzaSyCX5gxMA73PIZVCXuwqZf7odatmcOMAXYk' );

		//database details ONLY NEEDED IF USING A DATABASE
		define('DB_TYPE', 'pgsql');
		define('DB_HOST', 'localhost');
        define('DB_PORT', '5432');
		define('DB_NAME', 'SSC.Elfec');
		define('DB_USER', 'SSC.Elfec');
		define('DB_PASS', 'sscelfec2014');
		define('PREFIX', 'SSC.Elfec');

		//set prefix for sessions
		define('SESSION_PREFIX', 'ssc_elfec_');

		//optionall create a constant for the name of the site
		define('SITETITLE', 'SCC Elfec');

		//turn on custom error handling
		//set_exception_handler('core\logger::exception_handler');
		//set_error_handler('core\logger::error_handler');

		//set timezone
		date_default_timezone_set('America/La_Paz');

		//start sessions
		\helpers\session::init();

		//set the default template
		\helpers\session::set('template', 'default');
	}

}
