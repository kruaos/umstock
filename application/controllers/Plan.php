<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class plan extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('plan_model');

	}

	public function index()
	{
		redirect(site_url('/home/'));
	}

	public function plan_add()
	{
		$this->plan_model->plan_add_profile();
	}

	public function plan_edit()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/plan_view_edit');
		$this->load->view('template/footer');
	}

	public function plan_update()
	{
		$this->plan_model->plan_update_profile();
	}

	public function plan_del()
	{
		$this->plan_model->plan_del_profile();
	}




	public function blank()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('blank');
		$this->load->view('template/footer');	
	}
}
?>