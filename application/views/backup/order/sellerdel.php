<?
$sellerID=$_GET['sellerID'];

include "../config/connect.php";
$sql="UPDATE tb_seller SET sellerStatus='0' WHERE sellerID='$sellerID'";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ../order/seller.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>