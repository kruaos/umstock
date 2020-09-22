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
        <a class="nav-link dropdown-toggle" href="" id="dropdown05" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false"> <i class="fas fa-box"></i> เบิกพัสดุ </a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="<?php echo site_url('/members/edit');?>">1.1. แก้ไขข้อมูลส่วนตัว</a>
          <a class="dropdown-item" href="<?php echo site_url('/order/basket');?>">1.2. ทำรายการเบิกพัสดุ</a>
        </div>
      </li>

<?php 
  }
// กำหนดให้แสดงเฉพาะเจ้าหน้าที่   
  if($_SESSION['authority']=='s'){
?>      
<!-- เมนูที่ 2 -->
<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="dropdown05" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false"><i class="far fa-calendar-alt"></i>  จัดการพัสดุ</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="<?php echo site_url('/order/addorder');?>">2.1. บันทึกรายการพัสดุ </a>
          <a class="dropdown-item" href="<?php echo site_url('/order/addproduct');?>">2.2. เพิ่มรายการพัสดุ </a>
          <a class="dropdown-item" href="<?php echo site_url('/order/seller');?>">2.3. เพิ่มรายการร้านค้า </a>
          <hr>
          <a class="dropdown-item" href="<?php echo site_url('/order/approval');?>">2.4. แก้ไขรายการพัสดุ </a>
          <a class="dropdown-item" href="<?php echo site_url('');?>">2.5. ตั้งค่าพัสดุในรายการ </a>
          <a class="dropdown-item" href="<?php echo site_url('/report/ReportProduct');?>" >2.9. รายงานรับ-จาย พัสดุ </a>

        </div>
      </li>

  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="dropdown05" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false"><i class="fas fa-folder-open"></i>  จัดการบัญชี/โครงการ</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="<?php echo site_url('/order/plan');?>">2.1. เพิ่มแผนงาน</a>
          <a class="dropdown-item" href="<?php echo site_url('/product/category');?>">2.2. เพิ่มโครงการ</a>
          <a class="dropdown-item" href="<?php echo site_url('/product/category');?>">2.3. แก้ไขบัญชี/โครงการ</a>
          <hr>
          <a class="dropdown-item" href="<?php echo site_url('/report/CategoryReportSelect');?>">2.8. รายงานบัญชี/ โครงการ </a>

        </div>
      </li>
      <!-- เมนูที่ 2 -->
      
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> จัดการเจ้าหน้าที่</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
          <a class="dropdown-item" href="<?php echo site_url('/members/department');?>">4.2. เพิ่มกอง/ฝ่าย/งาน </a>
          <a class="dropdown-item" href="<?php echo site_url('/members/management');?>" >2.5. เพิ่มพนักงาน/เจ้าหน้าที่</a>
          <a class="dropdown-item" href="<?php echo site_url('/members/AuthMem');?>">4.1. กำหนดสิทธิผู้ใช้บริการ </a>
          <hr>
          <a class="dropdown-item" href="<?php echo site_url('/report/ReportCustomer');?>">4.4. รายงานรายบุคคล</a>
          <?php 
          $sess_authority=$this->session->userdata('authority');
          $sess_memberid=$this->session->userdata('userid');
          
          ?>
        </div>
      </li>
      <?php
  }
  ?> 

<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="" id="dropdown05" 
  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-file-alt"></i> เอกสาร/รายงาน</a>
  <div class="dropdown-menu" aria-labelledby="dropdown05">
    <a class="dropdown-item" href="<?php echo site_url('/report/reportmanage');?>">1.5. จัดการใบเบิกคำขอ </a>
    <a class="dropdown-item text-danger" href="<?php echo site_url('');?>">1.6. รายงานสรุป ทั้งหมด </a>
    <a class="dropdown-item text-danger" href="<?php echo site_url('');?>">4.5. เกี่ยวกับเรา</a>
  </div>
</li>     
<?php 
      if($sess_memberid=='43'or $sess_authority=='m')
          {
?>

          
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="dropdown05" 
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user-shield"></i> Admin</a>
        <div class="dropdown-menu" aria-labelledby="dropdown05">
        <a class="dropdown-item " href="<?php echo site_url('/home/adminumong');?>">4.6. ประวัติเข้าใช้</a>
          <a class="dropdown-item " href="<?php echo site_url('/home/adminumong');?>">4.7. จัดการสมาชิก </a>
          <a class="dropdown-item " href="<?php echo site_url('');?>">4.8. admin</a>
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