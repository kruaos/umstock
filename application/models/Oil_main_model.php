<?php
class Oil_main_model  extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
// ==================================================================================
// 1. ฟังชั่น การเพิ่ม 
// 2. ฟังชั่น การเลือก 
// 3. ฟังชั่น การลบ update
// ==================================================================================

// ----------------------------------------------------------------------------------
// 1. ฟังชั่น การเพิ่ม 
// ----------------------------------------------------------------------------------

  public function oil_booking_add()
  {

  	$sql="SELECT max(oil_order_number) as max_order_number FROM `oil_order` where oil_order_status='1'";
    $query=$this->db->query($sql)->result();
    foreach ($query as $rs) {
    	$max_order_number= $rs->max_order_number;
    }
		$day_use=sprintf("%02d",$this->input->post('day_use'));
		$month_use=sprintf("%02d",$this->input->post('month_use'));
		$year_use=$this->input->post('year_use');

		$oil_order_id='';
		$oil_order_number=$max_order_number+1;
		$oil_order_customerID=$this->input->post('oil_order_customerID');
		$car_member_display=$this->input->post('car_member_display');
		$oil_order_oil_type=$this->input->post('oil_order_oil_type');
		$oil_order_quantity=$this->input->post('oil_order_quantity');
		$oil_order_mile=$this->input->post('oil_order_mile');
		$oil_order_lasttimeorder=$year_use.'-'.$month_use.'-'.$day_use;
		$oil_order_manager1_approve=$this->input->post('oil_order_manager1_approve');
		$oil_order_manager2_approve='';
		$oil_order_getoil_quantity='';
		$oil_order_createdate =date('Y-m-d H:i:s');
		$oil_order_lastupdate='';
		$oil_order_status='1';

   		$sql="INSERT INTO oil_order VALUES ('$oil_order_id', '$oil_order_number', '$oil_order_customerID', '$car_member_display', '$oil_order_oil_type', '$oil_order_quantity', '$oil_order_mile', '$oil_order_lasttimeorder', '$oil_order_manager1_approve', '$oil_order_manager2_approve', '$oil_order_getoil_quantity', '$oil_order_createdate', '$oil_order_lastupdate', '$oil_order_status')";
	    $query=$this->db->query($sql);
  }



// ----------------------------------------------------------------------------------
// 2. ฟังชั่น การเลือก 
// ----------------------------------------------------------------------------------
  public function show_all_oilorder($userid)
  {
  	$sql="SELECT * FROM oil_order where oil_order_customerID=$userid and oil_order_status='1'";
    $query=$this->db->query($sql);
    return $query->result(); 
  }


  public function show_oilorder_all()
  {
    $sql="SELECT * FROM oil_order where oil_order_status='1'";
    $query=$this->db->query($sql);
    return $query->result(); 
  }

  public function max_oilorder()
  {
  	$sql="SELECT max(oil_order_number) as max_order_number FROM `oil_order` where oil_order_status='1'";
    $query=$this->db->query($sql);
    return $query->result(); 
  }





// ----------------------------------------------------------------------------------
// 3. ฟังชั่น การลบ update
// ----------------------------------------------------------------------------------

  
  public function oil_approval_accept($oil_order_id)
  {
    $oil_order_manager2_approve='18';
    $sql="UPDATE oil_order set  oil_order_manager2_approve='$oil_order_manager2_approve' where oil_order_id=$oil_order_id ";
    $query=$this->db->query($sql);
  }

  public function oil_approval_unaccept($oil_order_id)
  {
    $oil_order_manager2_approve='0';
    $sql="UPDATE oil_order set  oil_order_manager2_approve='$oil_order_manager2_approve' where oil_order_id=$oil_order_id ";
    $query=$this->db->query($sql);
  }


  public function oil_booking_cancel($oil_order_id)
  {
  	$sql="UPDATE oil_order set  oil_order_status='0' where oil_order_id=$oil_order_id ";
    $query=$this->db->query($sql);
  }



}
?>