<?
date_default_timezone_set("Asia/Bangkok");

$DepatName=$_POST['DepatName'];
$statusDepa=$_POST['statusDepa'];
$rootDepaID=$_POST['rootDepaID'];



if ($DepatName=="") {
	
	echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>"; 
	echo "<a href=departmentt.php>";
	exit();
}

include "../config/connect.php";
$sql="insert into tb_department values('','$DepatName','$rootDepaID','$statusDepa')";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	echo $sql;
	header("Location: departmentt.php");
	exit(0);
} else {
	echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
}
mysql_close($Conn);
?>