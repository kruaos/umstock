<?php 



?>
<div class="container" style="margin-top:70px" >
  <div class="row" >
    <div class="col-12 ">
  <h3>เมนูการอนุมัติพัสดุ</h3>
    </div>
  <div class="col ">
  <table class="table  table-hover small table-sm">
    <thead>
      <tr>
        <th width='50'>ลำดับที่</th>
        <th width='50'>ใบเบิกที่</th>
        <th width='200'>ชื่อผู้เบิก</th>
        <th width='100'>วันที่ใช้ </th>
        <th width='100'>วันที่คืน</th>
        <th width='100' class='text-center'>สถานะ</th>
        <th width='300'class='text-center'>หมายเหตุ</th>
      </tr>
    </thead>
    <tbody>
<?php 



$num=1;
$sql = "select * from car_order where car_order_status=1 "; 
$result = $this->db->query($sql);
// echo "<pre>";print_r($result->result()); exit;
foreach ($result->result() as $row) {
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
  $car_order_allow= $row->car_order_allow;
  $car_order_status= $row->car_order_status;

?>
      <tr>
      <td><?php echo $num; $num=$num+1;?></td>
        <td><?php 
        if($car_order_number==0){
          echo "-";
        } else{
          echo $car_order_number;
        }   
        ?>
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
        <td><?php 
              echo $this->datetime_function->show_day($car_order_timeuse);      
          ?></td>
        <td><?php 
              echo $this->datetime_function->show_day($car_order_timeback);      
          ?></td>
        <?php 
        if($car_order_allow==0){
          echo "<td class='table-danger text-center'>รออนุมัติ</td>" ;
        }else{
          echo "<td class='table-success text-center'>อนุมัติแล้ว</td>" ;
        }
        ?>
        <td class='text-center'>
        <div class="col btn-group  btn-group-toggle" >
          <a class="col btn btn-primary btn-sm" href="<?php echo site_url('order/orderdetailapproval/'.$car_order_id);?>">รายละเอียด</a>
          <a class="col btn btn-info  btn-sm 
          <?php   
            if($car_order_allow==0){
            echo "disabled";  }  
            ?>" href="<?php echo site_url('order/approvalable/'.$car_order_id);?>">อนุมัติ</a>
          <?php 
          $sess_authority=$this->session->userdata('authority');
          $sess_memberid=$this->session->userdata('userid');
          if($sess_memberid=='43'or $sess_authority=='m'){
          ?>
          <a class="col btn btn-danger  btn-sm" href='<?php echo site_url('order/unapproval/'.$car_order_id);?>'>ยกเลิก</a>
        </div>
        <?php 
          }
        ?>

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
