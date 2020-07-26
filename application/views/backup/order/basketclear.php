<?
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";

$getsession=$_GET['getsession'];	// เก็บค่ารหัสสินค้าไว้ในตัวแปร $addProductID

$sql1 = "delete * from tb_basket where sessionID='$getsession'";
$result = mysql_db_query($dbname,$sql1);

if ($result) {
	//echo $sql1;
	header("Location: order.php");
	exit(0);
} else {
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);

?>