<?php
class plan_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

  public function plan_add_profile()
  {
    date_default_timezone_set("Asia/Bangkok");

    $add_planname=$this->input->post('add_planname');
    $add_department=$this->input->post('add_department');
    $planstatus='0';


    if ($add_planname=="" or $add_department=="") {
      
      echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>"; 
      echo "<a href=plan.php>";
      exit();
    }

    $sql="insert into tb_plan values('','$add_planname','$planstatus','$add_department')";
    $result=$this->db->query($sql);
    if ($result) {
      redirect(site_url('order/plan'),'refresh');
    } else {
      echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
    }
  }

  public function plan_update_profile()
  {
    $planid=$this->input->post('planid');
    $add_planname=$this->input->post('add_planname');
    $sql_updata_plan="update tb_plan set planname='$add_planname' where planid='$planid' ";
    $result=$this->db->query($sql_updata_plan);
    if ($result) {
      redirect(site_url('order/plan'),'refresh');
    } else {
      echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
    };
  }

  public function plan_show_profile()
  {


  }

  public function plan_del_profile()
  {
    echo $planid=$this->uri->segment(3);

    $sql_del_plan="update tb_plan set planstatus='1' where planid='$planid' ";
    $result=$this->db->query($sql_del_plan);
    if ($result) {
      redirect(site_url('order/plan'),'refresh');
    } else {
      echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
    };
  }


}
?>