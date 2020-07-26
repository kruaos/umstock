<?php
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
include "../member/chksession.php";

$fullname=$_POST['fullname'];
$diveision=$_POST['diveision'];
$departmentID=$_POST['departmentID'];

$sql1 = "insert into tb_customer values('','$fullname','$departmentID','$diveision','1','0')";

$result= mysql_db_query($dbname,$sql1);
if ($result) {
	//echo $sql;
	header("Location: member.php");
	exit(0);
} else {
	echo $sql1;
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);

?>