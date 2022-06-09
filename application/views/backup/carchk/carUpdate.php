<?
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
include "../member/chksession.php";

$texttime=$_POST['carCreateDate'];	
$carCreateDate=(substr($texttime,6,4)-543)."-".substr($texttime,3,2)."-".substr($texttime,0,2).date(" H:m:s");


$memberID=$_SESSION[sess_memberID];
$carBrand=$_POST['carBrand'];	
$CarNumber=$_POST['CarNumber'];	
$Hpower=$_POST['Hpower'];	
$piston=$_POST['piston'];	
$CarUserID=$_POST['CarUserID'];	
$carEndDate='0000-00-00 00:00:00';
$midePerKM=$_POST['midePerKM'];	
$CarCusID=$_POST['CarCusID'];	
$statusCar='1';
$createdate=date("Y-m-d h:i:s");

$sql = "INSERT INTO cr_car values('','$CarNumber','$carBrand','$Hpower','$piston','$CarCusID','$carCreateDate','$carEndDate','$midePerKM','$statusCar','$createdate')";
$result = mysql_db_query($dbname,$sql);
if ($result) {
	//echo $sql;
	header("Location: car.php");
	exit(0);
} else {
	echo $sql;
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);
?>