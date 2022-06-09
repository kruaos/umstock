<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approvaled extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
	    $this->load->model('customer_main_model');
		$this->load->model('car_main_model');
	    $this->load->model('oil_main_model');
		$this->load->library('showdatetime_thai');

	}

	public function index()
	{
		redirect(site_url('/home/'));
	}


	public function blank()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/blank');
		$this->load->view('template/footer');	
	}

// ฟังชั่นของการทำงาน ===============================================================
// 1. ฟังชั่น ใช้รถส่วนกลาง
// 2. ฟังชั่น เบิกน้ำมัน 
// 3. ฟังชั่น ซ่อมรถ
// 4. ฟังชั่น เบิกพัสดุ 

// ==============================================================================

// --------------------------------------------------------------------------------------------

	public function carapproval()
	{
		$data['carorder']=$this->car_main_model->car_order_show_all();
		$data['show_oilorder']=$this->oil_main_model->show_oilorder_all($this->session->userdata('userid'));

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/carapproval_detail',$data);
		$this->load->view('oilorder/oilapproval_detail',$data);
		$this->load->view('template/footer');	
	}

	public function carprintorder()
	{
		$data['carorder']=$this->car_main_model->car_order_show_report();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/car_printdetail_menu',$data);
		$this->load->view('template/footer');	
	}


// ----------------------------------------------------------------------------------
// 1. ฟังชั่น ใช้รถส่วนกลาง
// ----------------------------------------------------------------------------------
	public function carapproval_accept()
	{
		$this->car_main_model->car_approval_accept();
		redirect(site_url('/approvaled/carapproval/'),'refresh');
	}

	public function carunapproval()
	{
		$this->car_main_model->car_approval_cancel();
		redirect(site_url('/approvaled/carapproval/'),'refresh');
	}

// ----------------------------------------------------------------------------------
// 2. ฟังชั่น เบิกน้ำมัน 
// ----------------------------------------------------------------------------------
	public function oilapproval_accept()
	{
		$this->oil_main_model->oil_approval_accept($this->uri->segment(3));
		redirect(site_url('/approvaled/carapproval/'),'refresh');
	}

	public function oilapproval_unaccept()
	{
		$this->oil_main_model->oil_approval_unaccept($this->uri->segment(3));
		redirect(site_url('/approvaled/carapproval/'),'refresh');
	}





}
?>