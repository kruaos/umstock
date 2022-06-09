<?php
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
include "../member/chksession.php";

$memberID=$sess_memberid;
$ordernum=$_GET['ordernum'];

// ยกเลิก tb_order
$sql4 = "update tb_order set staff1='0', orderIdReport='0' where  ordernum='$ordernum'";

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