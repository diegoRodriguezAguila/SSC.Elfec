<?php namespace controllers;
use core\view;

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
        $db = \helpers\database::get();
        $result = $db->select('SELECT * FROM testeando');
        $tam = count($result);
        for ($i = 0; $i < $tam; $i++)
        {
            $data['welcome_message'] = $data['welcome_message'] . "id: ".$result[$i]->id."  texto: ".$result[$i]->texto." <br />";
        }
            /* if (!$dbconn) {
                 $data['welcome_message'] = "An error occurred.\n";
             }
             $result = pg_query($dbconn, "SELECT * FROM testeando");
             if (!$result) {
                 $data['welcome_message'] =  "An error occurred on query.\n";
             }
             while ($row = pg_fetch_row($result)) {
                 $data['welcome_message'] = $data['welcome_message'] . "id: $row[0]  texto: $row[1] <br />";
             }*/
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
        $tuvieja = "hola harry";
        $data['title'] = $tuvieja;
        View::render('welcome/subpage',$data);
    }

}
