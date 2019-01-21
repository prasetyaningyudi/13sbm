<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('auth');				
		$this->load->helper('url');			
		$this->load->database();
		$this->load->model('app_data_model');		
		$this->data['app_data'] = $this->app_data_model->get();		
		$this->data['error'] = array();
		$this->data['title'] = 'Home';
	}

	public function index(){	
		$this->data['subtitle'] = 'Home';
		$this->load->view('main_home', $this->data);		
	}
}

