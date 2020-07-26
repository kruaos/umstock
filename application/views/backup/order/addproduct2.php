<?
date_default_timezone_set("Asia/Bangkok");
include ('../config/bsfunction.php');

$product=$_POST['add_product'];
$price=$_POST['add_price'];
$pic='1234';
$categoryID=$_POST['categoryID'];

$statuspro='0';

if ($product=="" or $price=="") {
?>
<div class="card">
  <div class="card-header">
    ข้อมูลผิดพลาด
  </div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text">ERROR : กรุณากรอกข้อมูลให้ครบ</p>
    <a href="addproduct.php" class="btn btn-primary" >ย้อนกลับ</a>
  </div>
</div>
<?php
	exit(0);

}

include "../config/connect.php";
$sql="insert into tb_product values('','$product','$price','$pic','$statuspro','$categoryID')";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	//echo "<h3>ข้อมูลของท่านถูกบันทึกเรียบร้อยแล้ว</h3>";
	header("Location: addproduct.php");
	exit(0);
} else {
?>

<div class="card">
  <div class="card-header">
  ไม่สามารถเพิ่มข้อมูลได้
  </div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text">ERROR : <?php echo $sql;?></p>
    <a href="addproduct.php" class="btn btn-primary" >ย้อนกลับ</a>
  </div>
</div>
<?php
}
mysql_close($Conn);
?>