<?
$id_del=$_GET[id_del];

include "../config/connect.php";
$sql="update tb_category set catestatus='1' where categoryID='$id_del' ";

$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ../order/categoryadd.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>