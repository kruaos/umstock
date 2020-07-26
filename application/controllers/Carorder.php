<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class carorder extends CI_Controller {

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
		$this->load->view('carorder/blank');
		$this->load->view('template/footer');	
	}

// ฟังชั่นของการทำงาน ===============================================================
// 1. เพิ่ม  แก้ไข  ลบ  รถ 					carincrease โดยเจ้าหน้าที่ 
// 2. จอง อนุมัติ ยกเลิกการจอง  รายการใช้รถ 	carbook		โดยผู้ใช้	
// 3. แสดงรายงาน 					 		carreport 	โดยผู้ใช้ และเจ้าหน้าที่ 
// ==============================================================================

// --------------------------------------------------------------------------------------------
// 1.1 เพิ่ม  แก้ไข  ลบ  รถ 				carincrease โดยเจ้าหน้าที่ 

	public function carincrease() // เมนูแรก สำหรับ การจัดการรถ 
	{
		$data['customer']=$this->customer_main_model->customer_show_online();
		$data['carmember']=$this->car_main_model->car_member_show_all();
		$data['car_max']=$this->car_main_model->car_max_number();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/carincrease_register',$data);
		$this->load->view('carorder/carincrease_tabel_view',$data);
		$this->load->view('template/footer');	
	}

	public function carincreaseedit() // เมนูแรก สำหรับ การจัดการรถ 
	{
		$data['customer']=$this->customer_main_model->customer_show_online();
		$data['carmember']=$this->car_main_model->car_member_show_all();
		$data['car_max']=$this->car_main_model->car_max_number();
		$data['carmember_select']=$this->car_main_model->car_member_select_detail($this->uri->segment(3));

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/carincrease_edit',$data);
		$this->load->view('template/footer');	
	}

// 1.2 ฟังชั่นดำเนินการ ----------------------------------------------------------------------------

	public function carincreaseadd()
	{
		$this->car_main_model->car_member_add();
		redirect(site_url('/carorder/carincrease/'),'refresh');
	}

	public function carincreasedel()
	{
		$this->car_main_model->car_member_del($this->uri->segment('3'));
		redirect(site_url('/carorder/carincrease/'),'refresh');
	}

	public function carincreaseupdate()
	{
		$this->car_main_model->car_member_update();
		redirect(site_url('/carorder/carincrease/'),'refresh');
	}


// --------------------------------------------------------------------------------------------
// 2.1 จอง อนุมัติ ยกเลิกการจอง  รายการใช้รถ 		carbook		โดยผู้ใช้


	public function caruserorder() // เมนูแรก สำหรับ การจัดการรถ 
	{
		$data['customer_show_boss']=$this->customer_main_model->customer_show_boss();
		$data['car_member_show_all']=$this->car_main_model->car_member_show_all();
		$data['car_max_order']=$this->car_main_model->car_max_order();
		$data['car_order_show_by_userid']=$this->car_main_model->car_order_show_by_userid();
		$data['carorder_all']=$this->car_main_model->car_order_show_all();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/car_order_register',$data);
		$this->load->view('carorder/car_report_show',$data);
		$this->load->view('template/footer');	
	}

	public function carorderedit() // เมนูแรก สำหรับ การจัดการรถ 
	{
		$data['customer_show_boss']=$this->customer_main_model->customer_show_boss();
		$data['car_member_show_all']=$this->car_main_model->car_member_show_all();
		$data['car_order_show_by_orderid']=$this->car_main_model->car_order_show_by_orderid($this->uri->segment(3));

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/car_order_edit',$data);
		$this->load->view('template/footer');	
	}

	public function carapproval()
	{
		$data['carorder']=$this->car_main_model->car_order_show_all();
		$data['show_oilorder']=$this->oil_main_model->show_all_oilorder($this->session->userdata('userid'));


		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/carapproval_detail',$data);
		$this->load->view('oilorder/oilapproval_detail',$data);
		$this->load->view('template/footer');	
	}


	// public function carusereditorder() // เมนูแรก สำหรับ การจัดการรถ 
	// {
	// 	$data['car_member_show_all']=$this->car_main_model->car_member_show_all();
	// 	$data['car_max_order']=$this->car_main_model->car_max_order();
	// 	$data['car_order_show_by_userid']=$this->car_main_model->car_order_show_by_userid();

	// 	$this->load->view('template/header');
	// 	$this->load->view('members/chksession');
	// 	$this->load->view('navmenu');
	// 	$this->load->view('carorder/car_order_register',$data);
	// 	$this->load->view('template/footer');	
	// }




// 2.2 ฟังชั่นดำเนินการ ----------------------------------------------------------------------------
	public function carorder_add()
	{
		$this->car_main_model->car_order_add();
		redirect(site_url('/report/reportmanage/'),'refresh');
	}

	public function carorderbook()
	{
		$this->car_main_model->car_order_add();
		redirect(site_url('/carorder/caruserorder/'),'refresh');
	}

	public function carorderupdate()
	{
		$this->car_main_model->car_order_update();
		redirect(site_url('/report/reportmanage/'),'refresh');
	}

	public function carordercancel()
	{
		$this->car_main_model->car_book_cancel($this->uri->segment(3));
		redirect(site_url('/report/reportmanage/'),'refresh');
	}

		public function carorderunbook()
	{
		$this->car_main_model->car_book_cancel($this->uri->segment(3));
		redirect(site_url('/carorder/caruserorder/'),'refresh');
	}


	public function carapproval_accept()
	{
		$this->car_main_model->car_approval_accept();
		redirect(site_url('/carorder/carapproval/'),'refresh');
	}

	public function carunapproval()
	{
		$this->car_main_model->car_approval_cancel();
		redirect(site_url('/carorder/carapproval/'),'refresh');
	}

	public function carunorder()
	{
		$this->car_main_model->car_unouder();
		redirect(site_url('/carorder/caruserorder/'),'refresh');
	}

// --------------------------------------------------------------------------------------------
// 3.1 แสดงรายงาน 					 		carreport 	โดยผู้ใช้ และเจ้าหน้าที่ 

	public function carreportshow()
	{
		$data['carorder_all']=$this->car_main_model->car_order_show_all();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/car_report_title');
		$this->load->view('carorder/car_report_show',$data);
		$this->load->view('carorder/print_btn');

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

	public function carorderdetail()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/carorder_detail_printout');
		$this->load->view('template/footer_for_print');	
	}	

	public function carmemberreport()
	{
		$data['car_member']=$this->car_main_model->car_member_show_all();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/car_member_report',$data);
		$this->load->view('carorder/print_btn');
		$this->load->view('template/footer');	
	}


	

// 3.2 ฟังชั่นดำเนินการ ----------------------------------------------------------------------------
	
	public function carbookcancel()
	{
		$this->car_main_model->car_book_cancel($this->uri->segment(3));
		redirect(site_url('/carorder/carprintorder/'),'refresh');
	}




}
?>