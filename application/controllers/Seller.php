<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class seller extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('seller_model');

	}

	public function index()
	{
		redirect(site_url('/home/'));
	}

	public function sel_edit()
	{

		$date['quary']=$this->seller_model->seller_show_profile($this->uri->segment(3));
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/seller_view_edit',$date);
		$this->load->view('template/footer');
	}
	public function sel_add()
	{
		$this->seller_model->seller_add_profile();
	}

	public function sel_update()
	{
		$this->seller_model->seller_update_profile();
	}

	public function sel_del()
	{
		$this->seller_model->seller_del_profile();
	}

}
?>