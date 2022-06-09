<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class report extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('order_model');
		$this->load->model('product_model');
		$this->load->model('car_main_model');
		$this->load->model('oil_main_model');
		$this->load->model('product_main_model');
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
		$this->load->view('blank');
		$this->load->view('template/footer');	
	}

// ======================================================================
// 1. แสดงส่วนจัดการรายงาน 			reportmanage
// 2. พิมพ์						reportmanage > print_order
// ======================================================================	

// 1. แสดงส่วนจัดการรายงาน 			reportmanage
	public function reportmanage()
	{
		$data['car_showorder_by_userid']=$this->car_main_model->car_order_show_by_userid();
		$data['product_showorder_by_userid']=$this->product_main_model->product_report_by_user();

		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('report/report_mange_product_order',$data);
		$this->load->view('report/report_mange_car_order',$data);
		$this->load->view('template/footer');
	}

	public function carprintorder()
	{
		$data1['carorder']=$this->car_main_model->car_order_show_report();
		$data2['show_oilorder']=$this->oil_main_model->show_oilorder_all();
		$data3['show_fixorder']=$this->car_main_model->show_fixorder_all();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('carorder/car_printorder_detail',$data1);
		$this->load->view('oilorder/oil_printorder_detail',$data2);
		$this->load->view('fixorder/fix_printorder_detail',$data3);
		$this->load->view('template/footer');	

		
	}




// end ----------------------------------------------------------------------
// 2. พิมพ์						reportmanage > print_order

	public function printproductorder()
	{
		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('report/Report_detail_print');
		$this->load->view('template/footer');
	}

	public function printcarorder()
	{
		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('carorder/carorder_detail_printout');
		$this->load->view('template/footer');
	}

// end ----------------------------------------------------------------------


	
	public function printorder()
	{
		$data['car_order_show_by_userid']=$this->car_main_model->car_order_show_by_userid();

		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('report/Report_Oder_view');
		$this->load->view('report/report_car_order_show',$data);
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
	}
	public function CategoryReportSelect()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/category_report_select');
		$this->load->view('template/footer');	
	}

	public function CategoryReport62()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/category_report_menu62');
		$this->load->view('template/footer');	
	}

	public function CategoryReport63()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/category_report_menu63');
		$this->load->view('template/footer');	
	}

	
	public function CategoryReport64()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/category_report_menu64');
		$this->load->view('template/footer');	
	}

	public function CategoryReport65()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/category_report_menu65');
		$this->load->view('template/footer');	
	}

	public function hiddenRow()
	{
		echo $categoryID=$this->uri->segment(3);
		$sql="UPDATE tb_category set catestatus='1' where categoryID=$categoryID";
	    $this->db->query($sql);
		redirect(base_url('report/CategoryReport65'));

	}

	public function CategoryReport()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/category_report_menu');
		$this->load->view('template/footer');	
	}

	public function Categoryreporedetail()
	{
		$data['product_detil_orderfile']=$this->product_model->show_detail_product_from_orderfile($this->uri->segment(3));
		$data['category']=$this->product_model->showorderfile($this->uri->segment(3));
		$data['category_mix_product']=$this->product_model->show_product_by_catgory($this->uri->segment(3));

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/category_report_detail',$data);
		$this->load->view('template/footer');	
	}

	public function ReportDetail()
	{
		$data['product_detil_orderfile']=$this->product_model->show_detail_product_from_orderfile($this->uri->segment(3));
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/product_detail_report',$data);
		$this->load->view('template/footer');	
	}
	
	public function ReportProduct()
	{
		$data['query_showall']=$this->product_model->show_product_show_all();
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/product_all_item',$data);
		$this->load->view('template/footer');	
	}	

	public function ReportDetail_showall()
	{
		$data['product_detil_orderfile']=$this->product_model->show_detail_product_from_orderfile($this->uri->segment(3));
		$data['show_detail_tb_product']=$this->product_model->show_detail_tb_product($this->uri->segment(3));
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/product_detail_report_backtoshowall',$data);
		$this->load->view('template/footer');	
	}

	public function ReportCustomer()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/report_by_customer');
		$this->load->view('template/footer');	
	}	

	public function ReportDetailCus()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('report/Report_Customer_detail');
		$this->load->view('template/footer');	
	}


}
?>