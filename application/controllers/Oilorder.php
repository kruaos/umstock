<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class oilorder extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('car_main_model');
	    $this->load->model('customer_main_model');
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
		$this->load->view('oilorder/blank');
		$this->load->view('template/footer');	
	}

// ฟังชั่นของการทำงาน ===============================================================
// 1. เพิ่ม  แก้ไข  ลบ  น้ำมัน  		oilbooking 
// 2. อนุมัติ ยกเลิกการจอง   			oilappoval	
// 3. แสดงรายงาน 					oilreport 	
// ==============================================================================

// ----------------------------------------------------------------------------------
// 1.1 เพิ่ม  แก้ไข  ลบ  น้ำมัน  		oilbooking 
// ----------------------------------------------------------------------------------

	public function oilbooking()
	{
		$data['car_member_show_all']=$this->car_main_model->car_member_show_all();
		$data['customer_show_boss']=$this->customer_main_model->customer_show_boss();
		$data2['show_oilorder']=$this->oil_main_model->show_all_oilorder($this->session->userdata('userid'));

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('oilorder/oil_booking_register',$data);
		$this->load->view('oilorder/oil_booking_view',$data2);
		$this->load->view('template/footer');	
	}


// 1.2 ฟังชั่นดำเนินการ 
// ----------------------------------------------------------------------------------
	public function oilbookingadd()
	{
		$data['max_oilorder']=$this->oil_main_model->max_oilorder();
		$this->oil_main_model->oil_booking_add($data);
		redirect(site_url('/oilorder/oilbooking/'),'refresh');
	}

	public function oilbookingcancel()
	{
		$this->oil_main_model->oil_booking_cancel($this->uri->segment(3));
		redirect(site_url('/oilorder/oilbooking/'),'refresh');
	}

	public function oilapproval_accept()
	{
		$this->oil_main_model->oil_approval_accept($this->uri->segment(3));
		redirect(site_url('/carorder/carapproval/'),'refresh');
	}

	public function oilapproval_unaccept()
	{
		$this->oil_main_model->oil_approval_unaccept($this->uri->segment(3));
		redirect(site_url('/carorder/carapproval/'),'refresh');
	}

// ----------------------------------------------------------------------------------
// 3. แสดงรายงาน 					oilreport 	
// ----------------------------------------------------------------------------------

	public function oilordershow()
	{
		$data['car_member_show_all']=$this->car_main_model->car_member_show_all();
		$data2['show_oilorder']=$this->oil_main_model->show_all_oilorder($this->session->userdata('userid'));

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');

		$this->load->view('oilorder/oil_booking_show',$data2);
		$this->load->view('print_btn');
		$this->load->view('template/footer');	
	}

}
?>