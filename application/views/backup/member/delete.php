<?
$id_del=$_GET[id_del];

include "../config/connect.php";
$sql="delete from tb_member where id='$id_del' ";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	echo "<h3>ลบข้อมูลออกจากระบบเรียบร้อยแล้วครับ</h3>";
	echo "[ <a href=view.php>กลับหน้าหลัก</a> ] ";
} else {
	echo "<h3>ไม่สามารถลบข้อมูลได้ครับ</h3>";
}
mysql_close();
?>