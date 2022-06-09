<?
$planid=$_GET['planid'];

include "../config/connect.php";
$sql="UPDATE tb_plan SET planstatus='1' WHERE planid='$planid'";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ../order/plan.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>