<?
date_default_timezone_set("Asia/Bangkok");

$cusid=$_GET['cusid'];



include "../config/connect.php";

$sql="UPDATE tb_customer SET status='0'
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