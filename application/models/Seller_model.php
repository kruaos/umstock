<?php
class Seller_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


  public function seller_show_profile($sellerID)
  {
    $sql = "tb_seller where sellerID='$sellerID'"; // ดึงข้อมูลจากตาราง product
    // echo $sql;exit;
    $query=$this->db->get($sql);
    return $query->result();
  }


  public function seller_add_profile()
  {
    date_default_timezone_set("Asia/Bangkok");

    $sellerName=$this->input->post('sellerName');
    $sellerAddress=$this->input->post('sellerAddress');
    $sellerStatus='1';


    if ($sellerName=="" or $sellerAddress=="") {
      echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>"; 
      exit();
    }

    $sql="insert into tb_seller values('','$sellerName','$sellerAddress','$sellerStatus')";
    $result=$this->db->query($sql);
    if ($result) {
      redirect(site_url('order/seller'),'refresh');
    } else {
      echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
    }
  }




  public function seller_update_profile()
  {
    $sellerAddress=$this->input->post('sellerAddress');
    $sellerName=$this->input->post('sellerName');
    $sellerID=$this->input->post('sellerID');
    $sql_updata_seller="update tb_seller set sellerName='$sellerName' ,sellerAddress='$sellerAddress' where sellerID='$sellerID' ";
    // echo $sql_updata_plan;
    $result=$this->db->query($sql_updata_seller);
    if ($result) {
      redirect(site_url('order/seller'),'refresh');
    } else {
      echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
    };
  }

  public function seller_del_profile()
  {
    echo $sellerID=$this->uri->segment(3);

    $sql_del_seller="update tb_seller set sellerStatus='0' where sellerID='$sellerID' ";
    $result=$this->db->query($sql_del_seller);
    if ($result) {
      redirect(site_url('order/seller'),'refresh');
    } else {
      echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
    };
  }


}
?>