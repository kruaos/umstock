<?
include "../member/chksession.php";
date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>UMStock</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link href="../config/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="../config/dist/js/bootstrap-datepicker-custom.js"></script>
<script src="../config/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
<style type="text/css">   
  
#printable { display: block; }  
  
@media print   
{   
     #non-printable { display: none; }   
     #printable { display: block; }   
}   
  
</style>   

</head>
<body > 
<?php 
include "../config/navmenu.php";
include "../config/connect.php";
function dott($n) {
  for ($i = 1; $i <= $n; $i++) {
     echo " . ";
  }
}
?>
<div class="container col-10 "  style="font-family: 'Sarabun', sans-serif; font-Size:14pt">
<div class="row" style="margin-top:30px">
<div class="col-12 ">

<p style="text-align: right"> เลขที่ <?php echo dott(15);?> .</p>
<p style="text-align: center"><b> ใบขอเบิกน้ำมันเชื้อเพลิง<br>
เทศบาลตำบลอุโมงค์ อำเภอเมือง จังหวัดลำพูน </b><br>
</p>
<p style="text-align: right">วันที่ <?php echo dott(10);?> เดือน <?php echo dott(20);?>พ.ศ.<?php echo dott(10);?><br></p>
<p style="margin-top:30px">
เรียน นายกเทศบาลตำบลอุโมงค์ <br>
</p>
<p style="text-indent: 2.5em;">ข้าพเจ้า <?php echo dott(10);?>ตำแหน่ง  <?php echo dott(10);?> 
ผู้รับผิดชอบ รถหมายเลขทะเบียน <?php echo dott(10);?> อื่นๆ (ระบุ) <?php echo dott(10);?> 
มีความประสงค์จะขอเบิกน้ำมันเชื้อเพลิงดังนี้ <br></p>

<div class="row">
<div class="col-2"></div>
<div class="col-4">
[ ] ไบโอดีเซล จำนวน <?php echo dott(10);?> ลิตร <br>
[ ] ไบโอดีเซล จำนวน <?php echo dott(10);?> ลิตร 
</div>
<div class="col-4">
[ ] ไบโอดีเซล จำนวน <?php echo dott(10);?> ลิตร <br>
[ ] ไบโอดีเซล จำนวน <?php echo dott(10);?> ลิตร 
</div>
</div>

เพื่อใช้กับรถหมายเลขทะเบียน <?php echo dott(10);?>  ระยะ ก.ม./ไมค์ เพื่อขอเบิกน้ำมัน <?php echo dott(10);?> 
ขอเบิกน้ำมันเชื้อเพลิงล่าสุด เมื่อวันที่ <?php echo dott(10);?> <br>
<p style="text-indent: 2.5em;">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ<br></p>

<div class='row'>
  <div class='col-4'></div>
  <div class='col-6'>
(ลงชื่อ) <?php echo dott(20);?> ผู้ขอเบิก <br>
<p style="text-indent: 2.5em;">(<?php echo dott(20);?>)</p><br>
(ลงชื่อ) <?php echo dott(20);?> ผู้อำนวยการกอง/ ผู้แทน <br>
<p style="text-indent: 2.5em;">(<?php echo dott(20);?>)</p><br>
  </div>
  <div class='col-2'></div>
</div>



<b>หมายเหตุ</b> ให้แนบบันทึกการใช้รถ (แบบ 4) ทุกครั้งที่มีการขอเบิกใช้น้ำมันเชื้อเพลิง 
สำหรับการเบิกจ่ายน้ำมันประเภทเบนซิล และ ดีเซล ให้นำใบส่งของจากบริษัทฯ ส่งให้พัสดุกองทุกครั้ง <br>
<div class='row'>
  <div class='col-4'></div>
  <div class='col-4'>
<p style="text-align: center">คำสั่ง <?php echo dott(30);?> <br></p>
[ ] อนุมัติ   จำนวน <?php echo dott(15);?> ลิตร <br>
[ ] ไม่อนุมัติ เนื่องจาก <?php echo dott(40);?>  <br>
<p style="text-indent: 2.5em;">(<?php echo dott(20);?> ) </p><br>
วันที่<?php echo dott(10);?> เดือน <?php echo dott(10);?> พ.ศ. <?php echo dott(10);?><br>
  </div>
  <div class='col-4'></div>
</div>

<p style="text-align: center"><br><b>สำหรับเจ้าหน้าที่  </b></p><br>
<div class='row'>
<div class='col'>
ได้เบิกจ่ายน้ำมันเชื้อเพลิง จำนวน 40 ลิตรให้เรียบร้อยแล้ว  <br>
(ลงชื่อ) <?php echo dott(20);?> ผู้รับ <br>
<p style="text-indent: 2.5em;">(<?php echo dott(20);?> ) </p><br>
(ลงชื่อ) <?php echo dott(20);?> ผู้จ่าย <br>
<p style="text-indent: 2.5em;">(<?php echo dott(20);?> ) </p><br>
</div>
<div class='col'>
ได้ลงบัญชีควบคุมการเบิกจ่ายน้ำมันเรียบร้อยแล้วเมื่อวันที่  <?php echo dott(10);?>  <br>
(ลงชื่อ) <?php echo dott(20);?>  <br>
<p style="text-indent: 2.5em;">(<?php echo dott(20);?> ) </p><br>
</div>
</div>

</div>
</div>
</div>







<div class=" text-center" style="background-color:Orange; margin-bottom:0; margin-top:30px">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
