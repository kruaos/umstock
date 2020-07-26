<?
include "../config/chksession.php";
$department=$_POST[department];
$division=$_POST[division];


include "../config/connect.php";
$sql="update tb_member set  department='$department', division='$division'  where username='$sess_username' ";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	echo "<h3>ข้อมูลของท่านถูกแก้ไขเรียบร้อยแล้ว</h3>";
	echo "[ <a href=main.php>กลับหน้าหลัก</a> ] ";
} else {
	echo "<h3>ไม่สามารถแก้ไขข้อมูลได้</h3>";
}
mysql_close();
?>