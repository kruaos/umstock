<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mainmenu extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('login_model');

	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('umstock_menu');
		$this->load->view('umstock_login');

	}

	public function info()
	{
	
		$data['query']=$this->login_model->loginchk();
		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('mainmenu');
		$this->load->view('show',$data);

	}


}
?>