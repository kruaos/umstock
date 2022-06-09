<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
$sess_memberid=$this->session->userdata('userid');
$fullname=$this->session->userdata('fullname');

?>
<div class="container" >
  

 <div class="row" >
    <div class="col-12 ">
     <h5>ข้อมูลการขออนุญาตใช้รถ</h5>
    </div>
  </div>
  <div class="row" >
    <div class="col">
     <table class="table  table-hover table-sm ">
      <thead>
        <tr>
          <th width='100'>เลขใบคำขอ</th>
          <th width='300'>ชื่อผู้เบิก</th>
          <th width='150'>วันที่เบิก</th>
          <th width='150'>วันที่ต้องการ</th>
          <th width='100' class='text-center'>สถานะ</th>
          <th width='100' class='text-center'>แก้ไข</th>
        </tr>
      </thead>
      <tbody>
      <?php 
          $cr_num=0;
          foreach ($car_order_show_by_userid as $cr) {
            $car_order_id=$cr->car_order_id;
            $car_order_number=$cr->car_order_number;
            $car_order_customer_number=$cr->car_order_customer_number;
            $car_order_timeuse=$cr->car_order_timeuse;
            $car_order_timeback=$cr->car_order_timeback;
            $car_order_allow2=$cr->car_order_allow2;
          ?>
          <tr>
          <td>
          </td>        
          <td><?php echo $fullname;?></td>
          <td>
            <?php 
              echo $this->showdatetime_thai->show_day($car_order_timeuse);
            ?>
          </td>
          <td><?php 
              echo $this->showdatetime_thai->show_day($car_order_timeback);
            ?></td>
          <?php 
          if($car_order_allow2==0){
            echo "<td class='table-danger text-center'>รอลงนาม</td>" ;
          }else{
            echo "<td class='table-success text-center'>ผู้บริหารลงนาม</td>" ;
          }
          ?>
          <td class="text-center">
          <a href="<?php echo site_url('carorder/carusereditorder/').$car_order_id;?>" class="btn btn-danger btn-sm">แก้ไข</a>
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
