<?php 

?>
<div class="container col" style="margin-top:70px" >
  <div class="row" >
    <div class="col-12 ">
  <h3>บันทึกประวัติการอนุญาตใช้รถส่วนกลาง</h3>
    </div>
  <div class="col ">
  <table class="table table-hover small table-sm">
    <thead>
      <tr>
        <th width='100'>วันที่ขออนุญาต</th>
        <th width='100'>ลำดับ</th>
        <th width='200'>ชื่อผู้ขออนุญาต</th>
        <th width='200'>หัวหน้าฝ่าย/ ผอ.กอง</th>
        <th width='200'>สถานที่ไป</th>
        <th width='200'>ปฏิบัติภาระกิจ</th>
        <th width='100'>คนนั่ง </th>
        <th width='100'>เริ่มใช้</th>
        <th width='100'>ถังวันที่ </th>
        <th width='250'>ผู้อนุมัติใช้รถ </th>
        <th width='200' class="d-print-none">บันทึก </th>

      </tr>
    </thead>
    <tbody>
<?php 

$num=1;
foreach ($carorder as $row) {
  $car_order_id= $row->car_order_id;
  $car_order_number= $row->car_order_number;
  $car_order_customer_number= $row->car_order_customer_number;
  $car_order_car_number= $row->car_order_car_number;
  $car_order_target= $row->car_order_target;
  $car_order_detail= $row->car_order_detail;
  $car_order_seat= $row->car_order_seat;
  $car_order_timeuse= $row->car_order_timeuse;
  $car_order_timeback= $row->car_order_timeback;
  $car_order_createdate= $row->car_order_createdate;
  $car_order_lastupdate= $row->car_order_lastupdate;
  $car_order_allow1= $row->car_order_allow1;
  $car_order_allow2= $row->car_order_allow2;
  $car_order_status= $row->car_order_status;

?>
      <tr>
      <td>
        <?php echo $this->showdatetime_thai->show_day($car_order_createdate); ?>
      </td>
      <td>
        <?php echo $car_order_number; ?>
      </td>
      <td>
        <?php 
          $sql2 = "select * from tb_customer where cusid=$car_order_customer_number"; 
          $result2 = $this->db->query($sql2);
          foreach ($result2->result() as $row2) {
            echo   $fullname = $row2->fullname; 
          }
        ?>      
      </td>
      <td>
          <?php 
          $sql2 = "select * from tb_customer where cusid=$car_order_allow1"; 
          $result2 = $this->db->query($sql2);
          foreach ($result2->result() as $row2) {
            echo   $fullname = $row2->fullname; 
          }
        ?> 
      </td>
      <td>
        <?php echo $car_order_target; ?>
      </td>
      <td>
        <?php echo $car_order_detail; ?>
      </td>
      <td>
        <?php echo $car_order_seat; ?>
      </td>
      <td><?php 
              echo $this->showdatetime_thai->show_day($car_order_timeuse);      
          ?>
      </td>
      <td><?php 
              echo $this->showdatetime_thai->show_day($car_order_timeback);      
          ?>
      </td>
      <td>
        <?php 
          if ($car_order_allow2==0){
            echo "รอลงนาม";
          }
          $sql2 = "select fullname from tb_customer where cusid=$car_order_allow2"; 
          $result2 = $this->db->query($sql2);
            foreach ($result2->result() as $row2) {
              echo   $fullname = $row2->fullname; 
          }
        ?> 
      </td>
        <td class="text-center  d-print-none" >
        <div class="col btn-group  btn-group-toggle" >
          <a class="col btn btn-info btn-sm <?php if($car_order_allow2<>0){echo "disabled"; } ?>" href="<?php echo site_url('carorder/carapproval_accept/'.$car_order_id);?>">อนุมัติ</a>
          <?php 
          $sess_authority=$this->session->userdata('authority');
          $sess_memberid=$this->session->userdata('userid');
          if($sess_memberid=='43'or $sess_authority=='m'){
          ?>



          <a class="col btn btn-danger  btn-sm" href='<?php echo site_url('carorder/carunapproval/'.$car_order_id);?>'>ยกเลิก</a>
          <?php 
            }
          ?>
        </div>
                </td>

      </tr>
<?php 
}
?>
    </tbody>
  </table>

  </div>
  </div>
 </div>
