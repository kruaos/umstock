<?
$id_del=$_GET[id_del];

include "../config/connect.php";
//$sql="delete from tb_product where id='$id_del' ";
$sql="UPDATE tb_product SET statusproduct='1' WHERE id='$id_del'";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ..\order\addproduct.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>