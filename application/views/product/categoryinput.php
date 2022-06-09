<?php
date_default_timezone_set("Asia/Bangkok");

$add_category=$_POST['add_category'];
$planid=$_POST['planid'];

$catestatus='0';

if ($add_category=="") {
	
	echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>"; 
	echo "<a href='".site_url('/product/category')."'>ย้อนกลับ</a>";
	exit();

}

$sql="insert into tb_category values('','$add_category','','$catestatus','$planid')";
$result=$this->db->query($sql);


if ($result) {
	echo "<a href='".site_url('/product/category')."'>ย้อนกลับ</a>";

	exit(0);
} else {

	echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
}
?>