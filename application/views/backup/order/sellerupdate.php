<?
$sellerID=$_POST['sellerID'];
$sellerName=$_POST['sellerName'];
$sellerAddress=$_POST['sellerAddress'];


include "../config/connect.php";
$sql="update tb_seller set sellerName='$sellerName',sellerAddress='$sellerAddress' where sellerID='$sellerID' ";

$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ../order/seller.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>