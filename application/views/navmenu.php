<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand " href="<?php echo site_url('/home/info');?>"  > UMStock </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
<?php 
    if(empty($_SESSION['authority'])){
?>
<?php    
    }else{
  if($_SESSION['authority']=='o'){

  }else{
?> 
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user"></i> ส่วนปฏิบัติงาน</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="<?php echo site_url('/members/edit');?>">1.1. แก้ไขข้อมูลส่วนตัว</a>
          <hr>
          <a class="dropdown-item" href="<?php echo site_url('/order/basket');?>">1.2. ทำรายการเบิกพัสดุ</a>
          <a class="dropdown-item" href="<?php echo site_url('/carorder/caruserorder');?>">1.3. ทำรายขออนุญาตใช้รถ</a>
          <a class="dropdown-item" href="<?php echo site_url('/oilorder/oilbooking');?>">1.4. ทำรายการเบิก น้ำมันเชื้อเพลิง </a>
          <a class="dropdown-item" href="<?php echo site_url('/report/reportmanage');?>">1.5. จัดการใบเบิกคำขอ </a>
          <a class="dropdown-item text-danger" href="<?php echo site_url('');?>">1.6. รายงานสรุป ทั้งหมด </a>
        </div>
      </li>
<?php 
  }
// กำหนดให้แสดงเฉพาะเจ้าหน้าที่   
  if($_SESSION['authority']=='s'){
?>      
<!-- เมนูที่ 2 -->
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-calendar-alt"></i>  ส่วนการพัสดุ</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="<?php echo site_url('/order/addorder');?>">2.1. บันทึกรายการพัสดุ </a>
          <a class="dropdown-item" href="<?php echo site_url('/order/plan');?>">2.2. เพิ่มแผนงาน</a>
          <a class="dropdown-item" href="<?php echo site_url('/product/category');?>">2.3. เพิ่มโครงการ</a>
          <a class="dropdown-item" href="<?php echo site_url('/order/addproduct');?>">2.4. เพิ่มรายการพัสดุ </a>
          <a class="dropdown-item" href="<?php echo site_url('/members/management');?>" >2.5. พนักงาน/เจ้าหน้าที่</a>
          <a class="dropdown-item" href="<?php echo site_url('/order/seller');?>">2.6. ร้านค้า </a>
          <hr>
          <a class="dropdown-item" href="<?php echo site_url('/order/approval');?>">2.7. อนุมัติคำขอเบิกพัสดุ </a>
          <a class="dropdown-item" href="<?php echo site_url('/report/CategoryReportSelect');?>">2.8. รายงานบัญชี/ โครงการ </a>
          <a class="dropdown-item" href="<?php echo site_url('/report/ReportProduct');?>" >2.9. รายงานพัสดุ </a>

        </div>
      </li>
<!-- เมนูที่ 2 -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-car"></i> ส่วนขอใช้รถ</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="<?php echo site_url('/carorder/caruserorder');?>">3.1. ขออนุญาตใช้รถส่วนกลาง </a>
          <a class="dropdown-item" href="<?php echo site_url('/oilorder/oilbooking');?>">3.2. ขอเบิกน้ำมันเชื้อเพลิง </a>
          <a class="dropdown-item text-danger" href="<?php echo site_url('/carorder/carfixorder');?>">3.3. ขออนุญาตซ่อมรถ </a>
          <hr>
          <a class="dropdown-item" href="<?php echo site_url('/approvaled/carapproval');?>">3.4. บันทึกการอนุญาต </a>
          <a class="dropdown-item" href="<?php echo site_url('/report/carprintorder');?>">3.5. พิมพ์ใบเบิก / ใบขออนุญาต </a>
          <a class="dropdown-item" href="<?php echo site_url('/carorder/carincrease');?>">3.6. เพิ่ม/ถอน คุรุภัณฑ์ รถ </a>
          <hr>
          <a class="dropdown-item" href="<?php echo site_url('/carorder/carmemberreport');?>">3.7. แสดงตารางข้อมูลรถ </a>
          <a class="dropdown-item" href="<?php echo site_url('/carorder/carreportshow');?>">3.8. แสดงรายงานขอใช้รถ </a>
          <a class="dropdown-item" href="<?php echo site_url('/oilorder/oilordershow');?>">3.9. แสดงรายงานการเบิกน้ำมัน  </a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-shield-alt"></i> ส่วนเจ้าหน้าที่</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="<?php echo site_url('/members/AuthMem');?>">4.1. กำหนดสิทธิผู้ใช้บริการ </a>
          <a class="dropdown-item" href="<?php echo site_url('/members/department');?>">4.2. เพิ่มกอง/ฝ่าย/งาน </a>
          <a class="dropdown-item" href="<?php echo site_url('/members/management');?>">4.3. จัดการข้อมูลพนักงาน </a>
          <hr>
          <a class="dropdown-item" href="<?php echo site_url('/report/ReportCustomer');?>">4.4. รายงานรายบุคคล</a>
          <a class="dropdown-item text-danger" href="<?php echo site_url('');?>">4.5. เกี่ยวกับเรา</a>
<?php 
          $sess_authority=$this->session->userdata('authority');
          $sess_memberid=$this->session->userdata('userid');
          if($sess_memberid=='43'or $sess_authority=='m')
          {
?>
          <a class="dropdown-item " href="<?php echo site_url('/home/adminumong');?>">4.6. ประวัติเข้าใช้</a>
          <a class="dropdown-item " href="<?php echo site_url('/home/adminumong');?>">4.7. จัดการสมาชิก </a>
          <a class="dropdown-item " href="<?php echo site_url('');?>">4.8. admin</a>
          
<?php 

            }
?>
        </div>
      </li>
<?php
  }
?>      
<!-- เมนูที่ 2 -->
        <li class="nav-item dropdown ">
      </li>

    </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo site_url('home/logout')?>" class="nav-link"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></li>
      </ul>
<?php
    }
?>
  </div>
</nav>