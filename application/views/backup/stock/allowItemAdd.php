<?php
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
include "../member/chksession.php";

$memberID=$sess_memberid;
$ordernum=$_GET['ordernum'];

$sql1='SELECT max(orderIdReport) as maxorder FROM tb_order';
$result1 = mysql_db_query($dbname, $sql1);
while ($row1 = mysql_fetch_array($result1)) {
	$maxorder = $row1["maxorder"]; 
}
	$setmaxorderid=$maxorder+1;

// ยกเลิก tb_order
$sql4 = "update tb_order set staff1='$sess_memberid' , orderIdReport=$setmaxorderid where  ordernum='$ordernum'";

$result= mysql_db_query($dbname,$sql4);
if ($result) {
	//echo $sql;
	header("Location: allowItem.php?");
	exit(0);
} else {
	//echo $sql1;
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);

?>