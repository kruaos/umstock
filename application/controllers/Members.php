<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class members extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('members_model');
	}

	public function index()
	{
		redirect(site_url('/home/info'));
	}

	public function blank()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('blank');
		$this->load->view('template/footer');	
	}

/* **************************************************
1. สมัครใช้งาน
2. แก้ไข 
3. ลบ 
4. แสดง 
************************************************** */

/* -----------------------------------------
1.1 สมัครใช้งาน
----------------------------------------- */
	public function register()
	{
		$data['show_customer_online']=$this->members_model->show_customer_unregis();
		$data['show_department_all']=$this->members_model->show_department_all();

		$this->load->view('template/header');
		$this->load->view('navmenu');
		$this->load->view('members/register_member',$data);
		$this->load->view('template/footer');	
	}

// 1.2 ฟังชั่น -------------------------------

	public function register_addmember()
	{
		$this->members_model->register_addmember();
		redirect(site_url(''));
	}





/* -----------------------------------------
2.1 แก้ไข 
----------------------------------------- */
	public function edit()
	{
		$cusid=$this->session->userdata('userid');
		$data['show_member_and_customer']=$this->members_model->show_member_and_customer($cusid);
		$data['show_department_all']=$this->members_model->show_department_all($cusid);

		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('members/register_form_edit',$data);
		$this->load->view('template/footer');	
	}

// 2.2 ฟังชั่น  ------------------------------











	public function AuthMem()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('members/AuthMem_view_index');
		$this->load->view('template/footer');	
	}
	
	public function AuthMemSet()
	{
		$this->members_model->AuthMem_setstatus();
	}

	public function department()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('members/department_view_index');
		$this->load->view('template/footer');	
	}

	public function department_edit()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('members/department_view_edit');
		$this->load->view('template/footer');	
	}

	public function department_add()
	{
		$this->members_model->department_add_level();
	}

	public function department_update()
	{
		$this->members_model->department_update_level();
	}

	public function department_del()
	{
		$this->members_model->department_del_level();
	}	

	public function management()
	{
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('members/members_management_index');
		$this->load->view('template/footer');	
	}

	public function member_edit()
	{
		$data['member']=$this->members_model->members_show_profile($this->uri->segment(3));
		$this->load->view('template/header');
		$this->load->view('members/chksession');
		$this->load->view('navmenu');
		$this->load->view('members/members_management_edit',$data);
		$this->load->view('template/footer');	
	}

	public function member_add()
	{
		$this->members_model->add_member_detial();	
	}

	public function member_del()
	{
		$data['member']=$this->members_model->del_member_detial($this->uri->segment(3));

	}

	public function member_update()
	{
		$this->members_model->update_member_detial();	

	}


}
