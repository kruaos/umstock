<?
session_start();
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
$sessionID= session_id();	// ฟังก์ชัน session_id เพื่อดึงค่า session ปัจจุบันมาเก็บไว้ในตัวแปร $sessionID
$addProductID=$_GET['addProductID'];	// เก็บค่ารหัสสินค้าไว้ในตัวแปร $addProductID

$sql1 = "select quantity from tb_basket where productID=$addProductID and sessionID='$sessionID'";
$result = mysql_db_query($dbname,$sql1);
while($row = mysql_fetch_array($result)){ 
	if($row['quantity']==1){ // ถ้าไม่มีสินค้าในตะกร้าเลยให้เรียก sql insert เพื่อเก็บรายการสินค้าลงตาราง basket
		$sql = "DELETE FROM tb_basket where  productID=$addProductID and sessionID='$sessionID'";
	}else{ 
		$sql = "update tb_basket set quantity=quantity-1 where  productID=$addProductID and sessionID='$sessionID'";
	}
}
if ($result) {
	//echo $sql1;
	header("Location: order.php");
	exit(0);
} else {
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);

?>