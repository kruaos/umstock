<?php
class customer_main_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


  public function customer_show_online()
  {
    $sql="select * from tb_customer where status=1";
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function customer_show_boss()
  {
    $sql="select fullname, cusid from tb_customer where customer_class=1";
    $query=$this->db->query($sql);
    return $query->result();
  }



  public function customer_show_detail($cusid)
  {
    $sql="select * from tb_customer where cusid=$cusid";
    $query=$this->db->query($sql);
    return $query->result();

  }

}
?>