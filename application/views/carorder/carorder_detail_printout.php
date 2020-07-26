<?php 
function dott($n) {
  for ($i = 1; $i <= $n; $i++) {
     echo " . ";
  }
}

function nbsp($n) {
  for ($i = 1; $i <= $n; $i++) {
     echo '&nbsp';
  }
}

$car_order_id=$this->uri->segment(3);

$sql10 = "SELECT * FROM car_order, car_member where car_order.car_order_id=$car_order_id and  car_order.car_order_car_number=car_member.car_member_number  "; 
$result10=$this->db->query($sql10);
// echo "<pre>";print_r($result10->result());exit;

foreach ($result10->result()  as $rs) {

    $car_order_id=$rs->car_order_id;
    $car_order_number=$rs->car_order_number;
    $car_order_customer_number=$rs->car_order_customer_number;
    $car_order_car_number=$rs->car_order_car_number;
    $car_order_target=$rs->car_order_target;
    $car_order_detail=$rs->car_order_detail;
    $car_order_seat=$rs->car_order_seat;
    $car_order_timeuse=$rs->car_order_timeuse;
    $car_order_timeback=$rs->car_order_timeback;
    $car_order_createdate=$rs->car_order_createdate;
    $car_order_lastupdate=$rs->car_order_lastupdate;
    $car_order_allow1=$rs->car_order_allow1;
    $car_order_status=$rs->car_order_status;

    
    $car_member_display=$rs->car_member_display;



      $sql6 = "select * from tb_customer where cusid=$car_order_customer_number"; 
      $result6 = $this->db->query($sql6);
      foreach ($result6->result()  as $row6) {
          $fullnamecus = $row6->fullname; 
          $diveision = $row6->diveision; 
        }
        if($car_order_allow1=='0'){
              $fullnameAllow = "";
        }else{
          $sql7 = "select * from tb_customer where cusid=$car_order_allow1"; 
          $result7 = $this->db->query($sql7);
          foreach ($result7->result()  as $row7) {
              $fullnameAllow = $row7->fullname; 
          }
       }
}

?>
<div class="container "  >

  <div class="row">
    <!-- <a class="btn btn-danger btn-sm col d-print-none" href='<?php echo site_url('carorder/carprintorder');?>'>ย้อนกลับ</a> -->
    <a class="btn btn-info btn-sm col d-print-none " onClick="window.print()" >พิมพ์</a>
  </div>
</div>
<br>
<div class="container page "  style="font-family: 'Sarabun', 'sans-serif'; font-size:16pt;">
  <div class="row">
    <div class="col  text-center"><h4>ใบขออนุญาตใช้รถส่วนกลาง</h4></div>
  </div>
  <div class="row"  style="margin-top:50px">
    <div class="col ">
      <!-- ลำดับที่  -->
      <?php /*
                if($car_order_number==0){
                  echo "-รออนุมัติ-";
                }else{
                  echo $car_order_number;
                }
            */
      ?>
    </div>

  </div>
  <div class="row" style="margin-top:30px">
    <div class="col-6"></div>
    <div class="col-6">
        <?php
          echo "วันที่ ".$this->showdatetime_thai->show_fullday($car_order_createdate);    
        ?>
    </div>
  </div>
  <div class="row" style="margin-top:30px">
    <div class="col "  >เรียน นายกเทศมนตรีตำบลอุโมงค์</div>
  </div>
  <div class="row" style="margin-top:30px">
    <div class="col-1"></div>
    <div class="col-1">
      ข้าพเจ้า 
    </div>
    <div class="col" style="BORDER-BOTTOM: #000000 2px dotted">
      <?php echo $fullnamecus;?>
    </div>
    <div class="col-1">
      ตำแหน่ง 
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     <?php echo $diveision;?>
    </div>
  </div>

  <div class="row" style="margin-top:10px">
    <div class="col-4">
      ขออนุญาตใช้รถ หมายเลขทะเบียน 
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     <?php echo $car_member_display;?>
    </div>
  </div>
  <div class="row" style="margin-top:10px">
    <div class="col-3">
      ไปที่ (สถานที่ไป)
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     <?php echo $car_order_target;?>
    </div>
  </div>
  <div class="row" style="margin-top:10px">
    <div class="col-1">
      เพื่อ 
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     <?php echo $car_order_detail;?>
    </div>
    <div class="col-1">
      มี 
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     คนนั่ง <?php echo $car_order_seat;?> คน
    </div>
  </div>
  <div class="row" style="margin-top:10px">
    <div class="col-1">
      ใน 
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     วันที่ <?php echo $this->showdatetime_thai->show_fullday($car_order_timeuse);?>
    </div>
    <div class="col-1">
      เวลา 
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     <?php echo substr($car_order_timeuse,11,5)." น. ";?>
    </div>
  </div>
  <div class="row" style="margin-top:10px">
    <div class="col-1">
      ถึง
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     วันที่ <?php echo $this->showdatetime_thai->show_fullday($car_order_timeback);?>
    </div>
    <div class="col-1">
      เวลา 
    </div>
    <div class="col"  style="BORDER-BOTTOM: #000000 2px dotted">
     <?php echo substr($car_order_timeback,11,5)." น. ";?>
    </div>
  </div>  

<!-- หนึ่งลายเซ็น -->
  <div class="row" style="margin-top:100px">
    <div class="col text-right">ลงชื่อ </div>
    <div class="col-3" style="BORDER-BOTTOM: #000000 2px dotted"></div>
    <div class="col">ผู้ขออนุญาต</div>
  </div>
  <div class="row" style="margin-top:5px">
    <div class="col text-right">(</div>
    <div class="col-3 text-center" style="BORDER-BOTTOM: #000000 2px dotted"><?php echo $fullnamecus; ?></div>
    <div class="col text-left">)</div>
  </div>


<!-- หนึ่งลายเซ็น -->
  <div class="row" style="margin-top:100px">
    <div class="col text-right">ลงชื่อ </div>
    <div class="col-3" style="BORDER-BOTTOM: #000000 2px dotted">
    </div>
    <div class="col">หัวหน้าฝ่าย/ ผู้อำนวยการกองหรือผู้แทน</div>
  </div>
  <div class="row" style="margin-top:5px">

    <div class="col text-right">(</div>
    <div class="col-3 text-center" style="BORDER-BOTTOM: #000000 2px dotted">
            <?php     
echo  $fullnameAllow;
      ?>
    </div>
    <div class="col text-left">)</div>
  </div>
  <div class="row" style="margin-top:40px">
    <div class="col text-right">วันที่</div>
    <div class="col-3 text-center" style="BORDER-BOTTOM: #000000 2px dotted"></div>
    <div class="col text-left"></div>
  </div>

<!-- หนึ่งลายเซ็น -->
  <div class="row" style="margin-top:100px">
    <div class="col-12" style="BORDER-BOTTOM: #000000 2px dotted"></div>
  </div>
  <div class="row" style="margin-top:40px">
    <div class="col-12" style="BORDER-BOTTOM: #000000 2px dotted"></div>
  </div>


<!-- หนึ่งลายเซ็น -->
  <div class="row" style="margin-top:100px">
    <div class="col text-right">ลงชื่อ </div>
    <div class="col-3" style="BORDER-BOTTOM: #000000 2px dotted"></div>
    <div class="col">ผู้มีอำนาจสั่งใช้รถ</div>
  </div>
  <div class="row" style="margin-top:5px">
    <div class="col text-right">(</div>
    <div class="col-3 text-center" style="BORDER-BOTTOM: #000000 2px dotted"></div>
    <div class="col text-left">)</div>
  </div>
  <div class="row" style="margin-top:40px">
    <div class="col text-right">วันที่</div>
    <div class="col-3 text-center" style="BORDER-BOTTOM: #000000 2px dotted"></div>
    <div class="col text-left"></div>
  </div>
  

</div>

