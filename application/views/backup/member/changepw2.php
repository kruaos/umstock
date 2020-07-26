<?
include "../config/chksession.php";
$oldpass=$_POST[oldpass];
$newpass=$_POST[newpass];
$newpass2=$_POST[newpass2];

if ($oldpass=="" or $newpass=="" or $newpass2=="" or $newpass<>$newpass2) {
	echo "<h3>ERROR : กรุณากรอกข้อมูลให้ครบนะครับ<h3>"; 	exit();
}
include "../config/connect.php";
$sql="select * from tb_member where username='$sess_username' and password='$oldpass' ";
$result=mysql_db_query($dbname,$sql);
$num=mysql_num_rows($result);
if($num<1) {
	echo $sql; 
	echo "<h3>ERROR : รหัสผ่านเดิม ไม่ถูกต้องครับ </h3>"; 	exit();
}

$sql="update tb_member set  password='$newpass' where username='$sess_username' ";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	echo "<h3>เปลี่ยนรหัสผ่านเรียบร้อยแล้วครับ</h3>";
	echo "[ <a href=main.php>กลับหน้าหลัก</a> ] ";
} else {
	echo "<h3>ไม่สามารถเปลี่ยนรหัสผ่านได้</h3>";
}
mysql_close($Conn);
?>
