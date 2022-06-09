<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('Product_model');

	}

	public function index()
	{
		redirect(site_url('/home/info'));
	}

	public function add_product()
	{
		$this->Product_model->add_product_from_staff();
	}

	public function update_product()
	{
		$this->Product_model->Update_Product_from_staff();
	}

	public function del()
	{
		$this->Product_model->del_Product_from_staff();
	}	


	public function edit()
	{
		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('order/product_view_edit');
		$this->load->view('template/footer');
	}

	public function printorder()
	{
		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('report/Report_Oder_view');
		$this->load->view('template/footer');
	}


	public function printorderDetial()
	{
		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('report/Report_detail_print');
		$this->load->view('template/footer');
	}


	public function printorderDel()
	{
		$this->order_model->del_order_from_tb_order($this->uri->segment(3));
		redirect(site_url('report/Report_Oder_viwe'));
	}


	public function category()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('product/category');
		$this->load->view('template/footer');	
	}

	public function categoryinput()
	{
		$this->load->view('product/categoryinput');
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