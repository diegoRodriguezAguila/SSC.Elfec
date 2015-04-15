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
		define('DEFAULT_CONTROLLER', 'session');
		define('DEFAULT_METHOD' , 'login');

		//set a default language
		define('LANGUAGE_CODE', 'en');

        //set the api key from Google API
        define( 'API_ACCESS_KEY', 'AIzaSyCX5gxMA73PIZVCXuwqZf7odatmcOMAXYk' );

        //sets the proxy if necesary
        define('PROXY_SERVER', 'proxy:8080');

		//database details ONLY NEEDED IF USING A DATABASE
		define('DB_TYPE', 'pgsql');
        define('DB_HOST', 'localhost');
        define('DB_PORT', '5432');
        define('DB_NAME', 'SSC.Elfec');
        define('DB_USER', 'postgres');
        define('DB_PASS', 'Aurora');
        define('PREFIX', 'SSC.Elfec');

        //Oracle DB
        define('ODB_TYPE', 'oci');
        define('ODB_HOST', 'oracle_preprod');
        define('ODB_PORT', '1531');
        define('ODB_NAME', '(DESCRIPTION =
                                (ADDRESS_LIST =
                                  (ADDRESS = (PROTOCOL = TCP)(HOST = oracle_preprod)(PORT = 1531))
                                )
                                (CONNECT_DATA =
                                  (SERVICE_NAME = SIDPROD)
                                )
                              )');
        define('ODB_USER', 'USR_SSC');
        define('ODB_PASS', 'elfec2015');

        //Centrality DB
        define('CENTRALITY_DB_TYPE', 'pgsql');
        define('CENTRALITY_DB_HOST', 'elfbdp01');
        define('CENTRALITY_DB_PORT', '5432');
        define('CENTRALITY_DB_NAME', 'SSC.Elfec');
        define('CENTRALITY_DB_USER', 'drodriguezd');
        define('CENTRALITY_DB_PASS', 'elfec2015');

		//set prefix for session
		define('SESSION_PREFIX', 'ssc_elfec_');

		//optionall create a constant for the name of the site
		define('SITETITLE', 'SCC Elfec');

		//turn on custom error handling
		//set_exception_handler('core\logger::exception_handler');
		//set_error_handler('core\logger::error_handler');

		//set timezone
		date_default_timezone_set('America/La_Paz');

		//start session
		\helpers\session::init();

		//set the default template
		\helpers\session::set('template', 'default');
	}

}
