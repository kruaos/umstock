<?php


class Car_main_model  extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
// ==================================================================================
// 1. ฟังชั่น การเพิ่ม แก้ ลบ แสดง รายการรถ       carincrease โดยเจ้าหน้าที่ 
// 2. ฟังชั่น การเพิ่ม แก้ ลบ แสดง รายการคำขอใช้   carbook   โดยผู้ใช้ 
// 3. ฟังชั่น แสดงรายงาน                       carreport   โดยผู้ใช้ และเจ้าหน้าที่ 
// 4. ฟังชั่น ทั่วไป ไม่เข้ากลุ่ม   
// ==================================================================================

// ----------------------------------------------------------
// 1. ฟังชั่น การเพิ่ม แก้ ลบ แสดง รายการรถ       carincrease โดยเจ้าหน้าที่ 

  public function car_member_add()
  {
    date_default_timezone_set("Asia/Bangkok");
    $Y=$this->input->post('year_own');
    $m=$this->input->post('month_own');
    $d=$this->input->post('day_own');

    $car_member_id="";
    $car_member_stockID=$this->input->post('car_member_stockID');
    $car_member_number=$this->input->post('car_member_number');
    $car_member_display=$this->input->post('car_member_display');
    $car_member_brand=$this->input->post('car_member_brand');
    $car_member_power=$this->input->post('car_member_power');
    $car_member_piston=$this->input->post('car_member_piston');
    $car_member_cusID=$this->input->post('car_member_cusID');
    $car_member_date_ownership=$Y."-".$m."-".$d;
    $car_member_oil_use=$this->input->post('car_member_oil_use');
    $car_member_status="1";
    $car_member_image="";   //$this->input->post('car_member_image');
    $car_member_customerID_foradd=$this->session->userdata('userid'); 
    $car_member_createdate=date('Y-m-d H:i:s');
    $car_member_lastupdate="";

    $sql="INSERT INTO car_member VALUES('$car_member_id','$car_member_number','$car_member_stockID','$car_member_display','$car_member_brand','$car_member_power','$car_member_piston','$car_member_cusID','$car_member_date_ownership','$car_member_oil_use','$car_member_status','$car_member_image','$car_member_customerID_foradd','$car_member_createdate','$car_member_lastupdate');";
    // echo $sql;
    // exit;
    $query=$this->db->query($sql);
  }

  public function car_member_del($car_member_id)
  {
    $sql="update car_member set car_member_status=0 where car_member_id=$car_member_id";
    $query=$this->db->query($sql);
  }

  public function car_member_update()
  { 
    $day_own =  $this->input->post('day_own');
    $month_own =  $this->input->post('month_own');
    $year_own =  $this->input->post('year_own');
    
    $data = array(
    'car_member_display' =>  $this->input->post('car_member_display'),
    'car_member_brand' =>  $this->input->post('car_member_brand'),
    'car_member_stockID' =>  $this->input->post('car_member_stockID'),
    'car_member_power' =>  $this->input->post('car_member_power'),
    'car_member_piston' =>  $this->input->post('car_member_piston'),
    'car_member_piston' =>  $this->input->post('car_member_piston'),
    'car_member_cusID' =>  $this->input->post('car_member_cusID'),
    'car_member_oil_use' =>  $this->input->post('car_member_oil_use'),
    'car_member_date_ownership' => $year_own."-".$month_own."-".$day_own
    );
    // print_r($data);     exit;
    $this->db->where('car_member_id',$this->input->post('car_member_id'));
    $this->db->update('car_member',$data);
  }

  public function car_member_select_detail($car_member_id)
  {
    $sql="select * from car_member where car_member_id=$car_member_id";
    $query=$this->db->query($sql);
    return $query->result();
  }


// ----------------------------------------------------------
// 2. ฟังชั่น การเพิ่ม แก้ ลบ แสดง รายการคำขอใช้   carbook   โดยผู้ใช้ 

  public function car_order_add()
  {
    date_default_timezone_set("Asia/Bangkok");
    $year_use=$this->input->post('year_use');
    $month_use=$this->input->post('month_use');
    $day_use=$this->input->post('day_use');
    $h_use=$this->input->post('h_use');
    $i_use=$this->input->post('i_use');


    $year_back=$this->input->post('year_back');
    $month_back=$this->input->post('month_back');
    $day_back=$this->input->post('day_back');
    $h_back=$this->input->post('h_back');
    $i_back=$this->input->post('i_back');

    $car_order_id="";
    $car_order_number=$this->input->post('car_order_number');
    $car_order_customer_number=$this->session->userdata('userid');
    $car_order_car_number=$this->input->post('car_order_car_number');
    $car_order_target=$this->input->post('car_order_target');
    $car_order_detail=$this->input->post('car_order_detail');
    $car_order_seat=$this->input->post('car_order_seat');
    $car_order_timeuse=$year_use."-".$month_use."-".$day_use." ".$h_use.":".$i_use.":".date('s');
    $car_order_timeback=$year_back."-".$month_back."-".$day_back." ".$h_back.":".$i_back.":".date('s');
    $car_order_createdate=date('Y-m-d H:i:s');
    $car_order_lastupdate="";
    $car_order_status="1";
    $car_order_allow1=$this->input->post('car_order_allow1');
    $car_order_allow2="";

    $sql="INSERT INTO car_order VALUES('$car_order_id','$car_order_number','$car_order_customer_number','$car_order_car_number','$car_order_target','$car_order_detail','$car_order_seat','$car_order_timeuse','$car_order_timeback','$car_order_createdate','$car_order_lastupdate','$car_order_allow1','$car_order_allow2','$car_order_status');";
    // echo $sql; exit;
    $query=$this->db->query($sql);
  }

  public function car_book_cancel($car_order_id)
  {
    $sql="update car_order set car_order_status=0 where car_order_id=$car_order_id";
    $query=$this->db->query($sql);
  }

  public function car_approval_accept()
  {
    
    $sql="select max(car_order_number) as car_max_order from car_order ";
    $query=$this->db->query($sql);
    foreach ($query->result() as $rs)
    {
      $car_order_number=$rs->car_max_order+1;
    }
    $car_order_id=$this->uri->segment(3);
    $userid=$this->session->userdata('userid');
    $car_order_allow2='18';
    $sql="update car_order set car_order_number=$car_order_number, car_order_allow2=$car_order_allow2 where car_order_id=$car_order_id";
    // echo "?นุมัติ";exit;
    $query=$this->db->query($sql);
    
  }
  public function car_approval_cancel()
  {
    $car_order_id=$this->uri->segment(3);
    $userid=$this->session->userdata('userid');
    $sql="update car_order set car_order_number=0, car_order_allow2=0 where car_order_id=$car_order_id";
    // echo "?นุมัติ";exit;
    $query=$this->db->query($sql);
    
  }  




// ----------------------------------------------------------
// 3. ฟังชั่น แสดงรายงาน                       carreport   โดยผู้ใช้ และเจ้าหน้าที่ 

  public function car_order_show_report()
  {
    $sql="select * from car_order where car_order_status=1 order by car_order_timeuse ASC";
    $query=$this->db->query($sql);
    return $query->result();
  }



// ----------------------------------------------------------
// 4. ฟังชั่น ทั่วไป ไม่เข้ากลุ่ม   

  public function car_member_show_all()
  {
    $sql="select * from car_member where car_member_status=1 order by car_member_createdate ASC";
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function car_order_show_all()
  {
    date_default_timezone_set("Asia/Bangkok");

    $today=date('Y-m-d');
    $sql="select * from car_order where car_order_status=1 and car_order_timeuse>='$today'
    order by car_order_timeuse ASC";
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function car_max_number()
  {
    $sql="select max(car_member_stockID) as car_max from car_member ";
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function car_max_order()
  {
    $sql="select max(car_order_number) as car_max_order from car_order ";
    $query=$this->db->query($sql);
    return $query->result();
  }
  public function car_order_show_by_userid()
  {
    $userid=$this->session->userdata('userid');
    $sql="select * from car_order where car_order_status=1 and car_order_customer_number=$userid order by car_order_timeuse ASC";
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function car_order_show_by_orderid($car_order_id)
  {
    $sql="select * from car_order where car_order_id=$car_order_id ";
    $query=$this->db->query($sql);
    return $query->result();
  }


// end ----------------------------------------------------------

  





// function car_order ------------------------------------ ฟังชั่นพื้นฐาน 



  public function car_unorder()
  {
    $car_order_id=$this->uri->segment(3);
    $car_order_status=0;
    $userid=$this->session->userdata('userid');
    $sql="update car_order set car_order_status=$car_order_status where car_order_id=$car_order_id";
    $query=$this->db->query($sql);
    
  }




}
?>