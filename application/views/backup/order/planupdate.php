<?
$planid=$_POST['planid'];
$add_planname=$_POST['add_planname'];
$add_department=$_POST['add_department'];


include "../config/connect.php";
$sql="update tb_plan set planname='$add_planname',deparmentID='$add_department' where planid='$planid' ";

$result=mysql_db_query($dbname,$sql);
if ($result) {
	header('Location: ../order/plan.php');
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close($Conn);
?>