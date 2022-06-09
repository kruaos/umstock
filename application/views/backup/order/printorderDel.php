<?php
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
include "../member/chksession.php";

$memberID=$sess_memberid;
$ordernum=$_GET['ordernum'];
// statusfile 1> คงสภาพ  2>จ่ายแล้ว 0>ยกเลิก
$sql1 = "select * from tb_orderdetail where orderID=$ordernum"; 
$result1 = mysql_db_query($dbname, $sql1);
while ($row1 = mysql_fetch_array($result1)) {
	$orderdetailID=$row1['orderdetailID'];
	$sql11 = "DELETE FROM tb_orderdetail where  orderdetailID=$orderdetailID ";
	$result11= mysql_db_query($dbname,$sql11);
}
$sql3 = "select * from tb_orderfile where orderID=$ordernum"; 
$result3 = mysql_db_query($dbname, $sql3);
while ($row3 = mysql_fetch_array($result3)) {
	$orderFileID=$row3['orderFileID'];
	$sql31 = "DELETE FROM tb_orderfile where orderFileID=$orderFileID";
	$result31= mysql_db_query($dbname,$sql31);
}

$sql4 = "update tb_order set status='0' where  ordernum='$ordernum'";

$result= mysql_db_query($dbname,$sql4);
if ($result) {
	//echo $sql;
	header("Location: printorder.php?");
	exit(0);
} else {
	//echo $sql1;
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);

?>