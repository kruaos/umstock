<?
$id_prod=$_POST['id_prod'];
$productName=$_POST['add_product'];
$price=$_POST['add_price'];
$categoryID=$_POST['categoryID'];


include "../config/connect.php";
$sql="update tb_product set productName='$productName',price='$price',categoryID='$categoryID' where id='$id_prod' ";

$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ../order/addproduct.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>