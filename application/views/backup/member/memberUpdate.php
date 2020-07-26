<?
date_default_timezone_set("Asia/Bangkok");

$fullname=$_POST['fullname'];
$diveision=$_POST['diveision'];
$departmentID=$_POST['departmentID'];
$cusid=$_POST['cusid'];



include "../config/connect.php";

$sql="UPDATE tb_customer SET 
fullname='$fullname',	diveision='$diveision',	department='$departmentID'
WHERE cusid=$cusid";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	//echo $sql;
	header("Location: member.php");
	exit(0);
} else {
	echo $sql;
	echo "<h3>ไม่สามารถสมัครเป็นสมาชิกได้</h3>";
}
mysql_close($Conn);

?>