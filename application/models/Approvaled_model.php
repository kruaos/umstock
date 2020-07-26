<?php
class Approvaled_model  extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
// ==================================================================================
// 1. การขอ ใช้รถส่วนกลาง
// 2. การขอ เบิกน้ำมัน 
// 3. การขอ ซ่อมรถ
// 4. การขอ เบิกพัสดุ  
// ==================================================================================

// ----------------------------------------------------------------------------------
// 2. การขอ เบิกน้ำมัน 
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