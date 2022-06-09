<?
date_default_timezone_set("Asia/Bangkok");

$add_category=$_POST['add_category'];
$planid=$_POST['planid'];

$catestatus='0';


if ($add_category=="") {
	
	echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>"; 
	header("Location: categoryadd.php");
	exit();
}

include "../config/connect.php";
$sql="insert into tb_category values('','$add_category','','$catestatus','$planid')";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	//echo $sql;
	header("Location: categoryadd.php");
	exit(0);
} else {

	echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
}
mysql_close($Conn);
?>