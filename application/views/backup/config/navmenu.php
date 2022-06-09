<?php 
  error_reporting(~E_NOTICE);

    if($chkmain==null){
        $jumpto="../";
    }else{
        $jumpto="";
    }
?>
<?php 
$sess_authority=$_SESSION['sess_authority'];

  if ($sess_authority=='u'or $sess_authority=='s'){

?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
 <h3 class="text-muted"><a href ='<?php echo $jumpto;?>main.php'>UMStock</a></h3>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        1. ส่วนปฏิบัติงาน 
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?=$jumpto;?>member/edit.php">1.1. แก้ไขข้อมูลส่วนตัว</a>
        <a class="dropdown-item" href="<?=$jumpto;?>member/changepw.php">1.2. เปลี่ยนรหัสผ่าน</a><hr>
        <a class="dropdown-item" href="<?=$jumpto;?>order/basket.php">1.3. ทำรายการเบิกพัสดุ</a>
        <a class="dropdown-item text-danger" href="#" >1.4. ทำรายการเบิก น้ำมันเชื้อเพลิง </a>
        <a class="dropdown-item" href="<?=$jumpto;?>report/printorder.php">1.5. พิมพ์ใบเบิกพัสดุ </a>
        <a class="dropdown-item text-danger" href="#" >1.6. รายงานสรุป ทั้งหมด </a>
      </div>
    </li>
<?php 
  if($sess_authority=='s'){
  ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        2. ส่วนการพัสดุ
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?=$jumpto;?>order/addorder.php">2.1. บันทึกรายการพัสดุ </a>
        <a class="dropdown-item" href="<?=$jumpto;?>order/plan.php">2.2. เพิ่มแผนงาน</a>
        <a class="dropdown-item" href="<?=$jumpto;?>order/categoryadd.php">2.3. เพิ่มบัญชี/โครงการ</a>
        <a class="dropdown-item" href="<?=$jumpto;?>order/addproduct.php">2.4. เพิ่มรายการพัสดุ </a>
        <a class="dropdown-item text-danger" href="#" >2.5. ----  </a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        3. ส่วนน้ำมัน
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item text-danger" href="#" >3.1. รายการที่ [ปิด]</a>
        <a class="dropdown-item text-danger" href="#" >3.2. รายการที่ [ปิด]</a>
        <a class="dropdown-item text-danger" href="#" >3.3. รายการที่ [ปิด]</a>
        <a class="dropdown-item text-danger" href="#" >3.4. รายการที่ [ปิด]</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        4. ส่วนเจ้าหน้าที่
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?=$jumpto;?>member/AuthMem.php" >4.1. กำหนดสิทธิผู้ใช้บริการ </a>
        <a class="dropdown-item" href="<?=$jumpto;?>department/departmentt.php" >4.2. เพิ่มกอง/ฝ่าย/งาน</a>
        <a class="dropdown-item" href="<?=$jumpto;?>stock/allowItem.php" >4.3. อนุมัติคำขอเบิกพัสดุ </a>
        <a class="dropdown-item" href="<?=$jumpto;?>member/member.php" >4.4. จัดการข้อมูลสมาชิก </a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        5. ส่วนรายงาน
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?=$jumpto;?>report/CategoryReport.php">5.1. รายงานบัญชี/ โครงการ </a>
        <a class="dropdown-item" href="<?=$jumpto;?>report/ReportProduct.php" >5.2. รายงานพัสดุ </a>
        <a class="dropdown-item" href="<?=$jumpto;?>report/ReportCustomer.php">5.3. รายงานรายบุคคล</a>
      </div>
    </li>
<?php }   ?>
    <li class="nav-item dropdown">
      <a class="nav-link " href="<?=$jumpto;?>aboutas.php" id="navbardrop" >
          6. เกี่ยวกับเรา
      </a>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=$jumpto;?>member/logout.php">ออกจากระบบ</a>
      </li>    
    </ul>
  </div>  
</nav>
<?php 
}else{
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
 <h3 class="text-muted"><a href ='<?=$jumpto;?>main.php'>UMStock</a></h3>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        1. ข้อมูลส่วนตัว
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?=$jumpto;?>member/edit.php">1.1. แก้ไขข้อมูลส่วนตัว</a>
        <a class="dropdown-item" href="<?=$jumpto;?>member/changepw.php">1.2. เปลี่ยนรหัสผ่าน</a>
        <a class="dropdown-item" href="#">1.3. สรุปใบคำขอเบิกพัสดุ</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link " href="<?=$jumpto;?>aboutas.php" id="navbardrop" >
          5. เกี่ยวกับเรา
      </a>

    </li>
   
      <li class="nav-item">
        <a class="nav-link" href="<?=$jumpto;?>member/logout.php">ออกจากระบบ</a>
      </li>    
    </ul>
  </div>  
</nav>

<?php
}
?>
