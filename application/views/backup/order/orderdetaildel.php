<?
$id_del=$_GET['id_del'];
$productid=$_GET['productid'];

include "../config/connect.php";
//$sql="delete from tb_orderfile where orderFileID='$id_del' ";
$sql="UPDATE tb_orderfile SET statusfile='1' WHERE orderFileID='$id_del'";

$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ../order/orderdetail.php?productid='.$productid.'');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>