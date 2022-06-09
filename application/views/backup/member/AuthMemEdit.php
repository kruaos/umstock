<?
include "../config/chksession.php";
include "../config/connect.php";

$memberID=$_GET['memberID'];
$setid=$_GET['setid'];


$sql="update tb_member set authority='$setid' where memberID='$memberID' ";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	header("Location: AuthMem.php");
	exit(0);
	echo "<h3>ข้อมูลของท่านถูกแก้ไขเรียบร้อยแล้ว</h3>";
} else {
	echo "<h3>ไม่สามารถแก้ไขข้อมูลได้</h3>";
}
mysql_close();
?>