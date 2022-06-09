<?php
class product_main_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

 // ฟังชั่นแบบใหม่ ---------------------------------------

  public function product_report_by_user() {
    $sess_memberid=$this->session->userdata('userid');
    $sql = "select * from tb_order where memberID=$sess_memberid and status<>0 "; 
    $query = $this->db->query($sql);
    return $query->result();
   }








}
?>