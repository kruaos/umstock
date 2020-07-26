<?
date_default_timezone_set("Asia/Bangkok");

$statusOrder=$_POST['statusOrder'];
$amount=$_POST['amount'];
$orderFileID=$_POST['orderFileID'];
$productID=$_POST['productID'];
$categoryID=$_POST['categoryID'];
$cusid=$_POST['cusid'];
$sellerID=$_POST['sellerID'];
$NumProductID=$_POST['NumProductID'];


include "../config/connect.php";

if($statusOrder=='in'){
$sql="UPDATE tb_orderfile SET 
productID='$productID',	amount='$amount',			
sellerID='$sellerID', NumProductID='$NumProductID'
WHERE orderFileID=$orderFileID";
}else if ($statusOrder=='ou'){
	$sql="UPDATE tb_orderfile SET 
	productID='$productID',	amount=-'$amount',			
	cusid='$cusid' 			
	WHERE orderFileID=$orderFileID";
}
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