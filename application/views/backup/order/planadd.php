<?
date_default_timezone_set("Asia/Bangkok");

$add_planname=$_POST['add_planname'];
$add_department=$_POST['add_department'];
$planstatus='0';


if ($add_planname=="" or $add_department=="") {
	
	echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>"; 
	echo "<a href=plan.php>";
	exit();
}

include "../config/connect.php";
$sql="select * from tb_plan where planname='$add_planname' ";
$result=mysql_db_query($dbname,$sql);
$num=mysql_num_rows($result);
if($num>0) {

	echo "<h3>ERROR : รายการซ้ำ ปรับปรุงข้อมูล </h3>";	 exit();
}
$sql="insert into tb_plan values('','$add_planname','$planstatus','$add_department')";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	//echo $sql;
	header("Location: plan.php");
	exit(0);
} else {
	echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
}
mysql_close($Conn);
?>