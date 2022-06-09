<?
//header("content-type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Bangkok");

$user_reg=$_POST['user_reg'];
$pass_reg=$_POST['pass_reg'];
$name_reg=$_POST['name_reg'];
$department=$_POST['department'];
$division=$_POST['division'];
$date_reg=date("Y-m-d H:m:s");
$authority="wait";

if ($user_reg=="" or $pass_reg=="" or $name_reg=="" ) {
	echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะครับ<h3>"; exit();
}

include "../config/connect.php";
$sql="select * from tb_member where username='$user_reg' ";
$result=mysql_db_query($dbname,$sql);
$num=mysql_num_rows($result);
if($num>0) {
	echo "<h3>ERROR : Username ซ้ำครับ </h3>";	 exit();
}
$sql="insert into tb_member values('','$user_reg','$pass_reg','$name_reg','$department',
'$division','$date_reg','$authority')";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	echo $sql;
	echo "<h3>ข้อมูลของท่านถูกบันทึกเรียบร้อยแล้ว</h3>";
	echo "<A HREF='../index.php'>คลิกเพื่อเข้าระบบสมาชิก</A><BR><BR>";
} else {
	echo $sql;
	echo "<h3>ไม่สามารถสมัครเป็นสมาชิกได้</h3>";
}
mysql_close();
?>