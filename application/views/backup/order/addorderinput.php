<?
date_default_timezone_set("Asia/Bangkok");
if($_POST['amount']==null){
	echo "โปรดระบุจำนวน <br> <a href='addorder.php'>ย้อนกลับ</a>";
	exit(0);

}

$texttime=$_POST['dateOrder'];

$createdate=(substr($texttime,6,4)-543)."-".substr($texttime,3,2)."-".substr($texttime,0,2).date(" H:m:s");


$productID=$_POST['productID'];
$categoryID=$_POST['categoryID'];
$orderID=1;
$planid=$_POST['planid'];
$cusid=$_POST['cusid'];
$status=$_POST['status'];
$sellerID=$_POST['sellerID'];
$NumProductID=$_POST['NumProductID'];

if ($status=="ou"){
	$text6=-($_POST['amount']);
	$sellerID='';
}else{
	$text6=$_POST['amount'];
	$cusid='';
}
$detail="";
$productPrice=$_POST['productPrice'];

include "../config/connect.php";
$sql="insert into tb_orderfile values
		('','$createdate','$productID','$categoryID','$orderID','$status','$text6','$productPrice','$detail','0',
		'$cusid','$sellerID','$NumProductID')";
$result=mysql_db_query($dbname,$sql);
if ($result) {
	//echo $sql;
	header("Location: addorder.php?categoryID=$categoryID");
	exit(0);
} else {
	echo $sql;
	echo "<h3>ไม่สามารถสมัครเป็นสมาชิกได้</h3>";
}
mysql_close($Conn);
?>