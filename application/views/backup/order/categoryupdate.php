<?
$id_cate=$_POST['id_cate'];
$add_category=$_POST['add_category'];
$add_department=$_POST['add_department'];


include "../config/connect.php";
$sql="update tb_category set categoryName='$add_category',planID='$add_department' 
		where categoryID='$id_cate' ";

$result=mysql_db_query($dbname,$sql);
if ($result) {
	echo $sql;
	header('Location: ../order/categoryadd.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>