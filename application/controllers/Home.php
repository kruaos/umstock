<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('login_model');
		$this->load->model('car_main_model');
		$this->load->library('showdatetime_thai');


	}

	public function index()
	{
		if (empty($_SESSION['authority']))
		{		

		$this->load->view('template/header_login');
		$this->load->view('navmenu');
		$this->load->view('login_view');
		$this->load->view('template/footer');
		}else{
			redirect(site_url('/home/info'));
		}
	}

	public function login()
	{	
		$this->login_model->loginchk();
			redirect(site_url('/home/info'));

	}

	public function info()
	{
		if (isset($_SESSION['authority']))
		{
		$data['car_order_show_by_userid']=$this->car_main_model->car_order_show_by_userid();

		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('main_view');
		$this->load->view('report/Report_Oder_show');
		// $this->load->view('report/report_car_order_show',$data);
		$this->load->view('template/footer');
		}else{
			redirect(site_url('/home/index'));
		}
	}

	public function adminumong()
	{
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('admin_umong');
		$this->load->view('template/footer_plus_table');
	}


	public function logout()
	{
		$this->login_model->logout();
	}

}
?>