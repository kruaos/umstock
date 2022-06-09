<?
date_default_timezone_set("Asia/Bangkok");

$sellerName=$_POST['sellerName'];
$sellerAddress=$_POST['sellerAddress'];
$sellerStatus='1';


if ($sellerName=="" or $sellerAddress=="") {
	
	echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะ  ครับ<h3>"; 
	header("Location: seller.php");
	exit();
}

include "../config/connect.php";
$sql="insert into tb_seller values('','$sellerName','$sellerAddress','$sellerStatus')";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	header("Location: seller.php");
	exit(0);
} else {
	echo "<h3>ไม่สามารถเพิ่มข้อมูลได้</h3>";
}
mysql_close($Conn);
?>