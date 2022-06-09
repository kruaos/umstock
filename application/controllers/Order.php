<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('order_model');
	    $this->load->model('Product_model');
	    $this->load->model('login_model');
	    $this->load->library('pagination');

	}

	public function index()
	{
		redirect(site_url('/home/'));
	}

	public function basket()
	{		
		$this->login_model->log_customer_use();
		$data['query']=$this->order_model->showcatgory();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/catagory_menu_foruser',$data);
		$this->load->view('template/footer');
	}

	public function seller()
	{		
		$this->login_model->log_customer_use();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/seller_view_index');
		$this->load->view('template/footer');
	}


// ส่วนการเบิกพัสดุ


	public function userorder($categoryID)
	{		
	    $data["rsIn"] = $this->Product_model->product_show_all_by_categoryID($categoryID);
 		$data["rsOut"] = $this->Product_model->ShowProAndBas($categoryID);
        $data["links"] = $this->pagination->create_links();
		$data['query']=$this->order_model->showorderfile($categoryID);
		
		$this->login_model->log_customer_use();

		$this->load->view('template/header_plus_table');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/userorder_view_v3', $data);
		$this->load->view('template/footer_plus_table');
	}

	public function UserbookOrder()
	{
		$this->order_model->user_book_order();
    	redirect(site_url('order/userorder/').$this->input->post('categoryID'));	
	}

	public function UserclearbookOrder()
	{
		$this->order_model->user_clear_book();
    	redirect(site_url('order/userorder/').$this->uri->segment(3));
	}


	public function UserUnbookOrder()
	{
		$this->order_model->user_unbook_order();
    	redirect(site_url('order/userorder/').$this->uri->segment(3));
	}

	public function userAddOrder()
	{
		$this->order_model->user_add_order();
    	redirect(site_url());
	}

// -------------------------------------------------   เมนูสำหรับ ส่วนพัสดุ

	public function addorder()
	{		
		$this->login_model->log_customer_use();

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$data['query']=$this->order_model->showcatgory();
		$this->load->view('order/catagory_menu_forstaff',$data);
		$this->load->view('template/footer');
	}

	public function stafforder($categoryID)
	{
		// $this->load->view('template/header');
		$this->load->view('template/table');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/stafforder_input_view');
		$this->load->view('order/stafforder_table_view');
		// $this->load->view('template/footer');
		$this->load->view('template/tb-footer');
	}

	public function Staff_add_order()
	{
		$this->order_model->staff_add_order();
	}


	public function stafforderdel()
	{
		$orderFileID=$this->uri->segment('3');
		$categoryID=$this->uri->segment('4');
		$this->order_model->del_order_from_tb_orderfile($orderFileID,$categoryID);
	}

//  -----------------------------
// เพิ่มส่วนแก้ไข การบันทึกแก้ไขรายการรับจ่ายสินค้า 
//  -----------------------------
	public function staffOrderEdit()
	{
		$this->load->view('template/header');
		// $this->load->view('template/table');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/stafforder_edit_view');
		// $this->load->view('order/stafforder_table_view');
		$this->load->view('template/footer');
		// $this->load->view('template/tb-footer');
	}
	// public function staffOrderUpdate()
	// {
	// 	$orderFileID=$this->uri->segment('3');
	// 	$categoryID=$this->uri->segment('4');
	// 	$this->order_model->update_order_from_tb_orderfile($orderFileID,$categoryID);
	// }


	public function plan()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/plan_view_index');
		$this->load->view('template/footer');	
	}


	public function addproduct()
	{		
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$data['query']=$this->order_model->showcatgory();
		$this->load->view('order/catagory_menu_forproduct',$data);
		$this->load->view('template/footer');
	}

	public function product()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('order/product_view_index');
		$this->load->view('template/footer');	
	}	

// ---------------------------  เริ่มต้น ---- ส่วนการอนุม้ติพัสดุต่าง  --------------------------- 

	public function approval()
	{
		$this->login_model->log_customer_use();
		
		$this->load->view('template/header_plus_table');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('product/allowItem_view_index');
		$this->load->view('template/footer_plus_table');
	}

	public function orderdetailapproval()
	{
		$this->load->view('members/chksession');
		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('report/Report_detail_print_forstaff');
		$this->load->view('template/footer');
	}

	public function approvalable()
	{
		$this->order_model->appoval_is_ok($this->uri->segment(3));	
	}

	public function unapproval()
	{
		$this->order_model->appoval_is_cancel($this->uri->segment(3));
	}

// --------------------------- สิ้นสุด  ----   ส่วนการอนุม้ติพัสดุต่าง  --------------------------- 




	public function blank()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('blank');
		$this->load->view('template/footer');	
	}



}
