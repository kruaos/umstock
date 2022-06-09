<?
$depaID=$_GET['depaID'];

include "../config/connect.php";
$sql="update tb_department set statusDepa='0' where departmentID='$depaID' ";

$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ../department/departmentt.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>