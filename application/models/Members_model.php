<?php
date_default_timezone_set("Asia/Bangkok");

class members_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

  public function register_addmember()
  {
    $Username=$this->input->post('Username');
    $Password=$this->input->post('Password');
    $name_reg=$this->input->post('name_reg');
    $depa_reg=$this->input->post('depa_reg');
    $reg_date=date('Y-m-d H:i:s');

      if ($Username=="" or $Password=="" ) 
      {
        echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>";
        echo "<a href='".site_url()."members/register'>ย้อนกลับ</a>"; 
        exit();
      }

    $sql="insert into tb_member values('','$Username','$Password','$name_reg','$depa_reg','','$reg_date','')";
    $result=$this->db->query($sql);


  }




  public function members_show_profile($memberID)
  {
    $sql="select * from tb_customer where cusid=$memberID";
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function show_customer_online()
  {
    $sql="select * from tb_customer where status='1' order by cusid;";
    $query=$this->db->query($sql);
    return $query->result();
  }
  public function show_customer_unregis()
  {
    $sql="select * from tb_customer left join tb_member on tb_customer.cusid = tb_member.name  where status='1' and tb_member.name is null;";
    $query=$this->db->query($sql);
    return $query->result();
  }


  public function AuthMem_setstatus()
  {
    $memberID=$this->uri->segment(4);
    $authority=$this->uri->segment(3);
    echo $authority."/".$memberID;

    $sql="update tb_member set authority='$authority' where memberID='$memberID' ";
    $result=$this->db->query($sql);

    if ($result) {
      redirect(site_url('members/AuthMem/'),'refresh');
    } else {
      echo "<h3>ไม่สามารถแก้ไขข้อมูลได้</h3>";
    }
  }

// -----------------------------  การจัดการส่วน สำนัก/กอง ฝ่าย งาน 

  public function show_department_all()
  {
    $select_tb_deparment_all = "select * from tb_department where statusDepa<>0 and rootDepaID=0  order by departmentID"; 
    return $this->db->query($select_tb_deparment_all)->result();
  }


  public function department_add_level()
  {
    $DepatName=$this->input->post('DepatName');
    $statusDepa=$this->input->post('statusDepa');
    $rootDepaID=$this->input->post('rootDepaID');

    if ($DepatName=="") {
    echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>"; 
    exit();
    }

    $sql="insert into tb_department values('','$DepatName','$rootDepaID','$statusDepa')";
    $result=$this->db->query($sql);
    if ($result) {
    echo $sql;
        redirect(site_url('members/department/'),'refresh');
    } else {
    echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
    }
  }

  public function department_del_level()
  {
    $depaID=$this->uri->segment(3);
    $sql="update tb_department set statusDepa='0' where departmentID='$depaID' ";
    $result=$this->db->query($sql);
    if ($result) {
          redirect(site_url('members/department/'),'refresh');
    } else {
      echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
    }
  }

  public function department_update_level()
  {
    $departmentID_edit=$this->input->post('departmentID_edit');
    $departmentName_edit=$this->input->post('departmentName_edit');
    $sql_update_department="update tb_department set departmentName='$departmentName_edit' where departmentID='$departmentID_edit' ";
    $result=$this->db->query($sql_update_department);
    if ($result) {
      redirect(site_url('members/department/'),'refresh');
    } else {
      echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
    };
  }

// ---------------------- การจัดการข้อมูลสมาชิก 
  
  public function show_member_and_customer($cusid)  // ยังไมได้ใช้งาน 
  {
    $sql_select_customer="select * from tb_customer ,tb_member where tb_customer.cusid=tb_member.name and  tb_customer.cusid=$cusid";
    $result=$this->db->query($sql_select_customer)->result();
    // print_r($result);exit;
    return  $result;
  }



  public function add_member_detial()
  {
    $fullname=$this->input->post('fullname');
    $diveision=$this->input->post('diveision');
    $departmentID=$this->input->post('departmentID');

    echo $sql1 = "insert into tb_customer values('','$fullname','$departmentID','$diveision','1','0','0')";
    // echo $sql1;
    // exit;
    $result=$this->db->query($sql1);
    if ($result) {
      //echo $sql;
      redirect(site_url('members/management/'),'refresh');
      exit(0);
    } else {
       echo $sql1;
      echo "<h3>บันทึกล้มเหลว</h3>";
    } 
  }

  public function del_member_detial($cusid)
  {
    $sql="UPDATE tb_customer SET status='0' WHERE cusid=$cusid";
    $result=$this->db->query($sql);
    if ($result) {
      //echo $sql;
      redirect(site_url('members/management/'),'refresh');
      exit(0);
    } else {
       echo $sql1;
      echo "<h3>บันทึกล้มเหลว</h3>";
    } 
  }

  public function update_member_detial()
  {
    $fullname=$this->input->post('fullname');
    $diveision=$this->input->post('diveision');
    $departmentID=$this->input->post('departmentID');
    $cusid=$this->input->post('cusid');

    $sql="UPDATE tb_customer SET fullname='$fullname' , diveision='$diveision' ,department='$departmentID' WHERE cusid=$cusid";
    $result=$this->db->query($sql);
    if ($result) {
      //echo $sql;
      redirect(site_url('members/management/'),'refresh');
      exit(0);
    } else {
       echo $sql1;
      echo "<h3>บันทึกล้มเหลว</h3>";
    }  
  }


// -------------------------------ยังไม่ได้ดำเนินการใดๆ 
  


}
?>