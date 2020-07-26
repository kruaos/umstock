<?php 

?>
<div class="container"  >
  <div class="row" >
    <div class="p-2 bg-success col-12 ">
      พิมพ์ใบขออนุญาต การขอใช้รถส่วนกลาง
    </div>
  <div class="col ">
  <table class="table  table-hover small table-sm">
    <thead>
      <tr>
        <th width='100'>ลำดับที่</th>
        <th >ใบเบิกที่</th>
        <th >ชื่อผู้เบิก</th>
        <th >วันที่ใช้ </th>
        <th >วันที่คืน</th>
        <th class='text-center'>สถานะ</th>
        <th width='100' class='text-center'>หมายเหตุ</th>
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
  $car_order_status= $row->car_order_status;
  $car_order_allow2= $row->car_order_allow2;


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
              echo $this->showdatetime_thai->show_day($car_order_timeuse);      
          ?></td>
        <td><?php 
              echo $this->showdatetime_thai->show_day($car_order_timeback);      
          ?></td>
        <?php 
        if($car_order_allow2==0){
          echo "<td class='table-danger text-center'>รออนุมัติ</td>" ;
        }else{
          echo "<td class='table-success text-center'>อนุมัติแล้ว</td>" ;
        }
        ?>
        <td class='text-center'>
        <div class="col btn-group  btn-group-toggle" >
          <a class="col btn btn-primary btn-sm" href="<?php echo site_url('carorder/carorderdetail/'.$car_order_id);?>">แสดง</a>
          <?php 
          $sess_authority=$this->session->userdata('authority');
          $sess_memberid=$this->session->userdata('userid');
          if($sess_memberid=='43'or $sess_authority=='m'){
          ?>
          <a class="col btn btn-secondary btn-sm " href='<?php echo site_url('carorder/carbookcancel/'.$car_order_id);?>'>ยกเลิก</a>
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
