<?
session_start();
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
$sessionID= session_id();	
$addProductID=$_GET['addProductID'];	


$sql1 = "select count(ID) as 'countid' from tb_basket where productID=$addProductID and sessionID='$sessionID'";
$result = mysql_db_query($dbname,$sql1);
while($row = mysql_fetch_array($result)){ 
	if($row['countid']==0){ 
		 $sql = "insert into tb_basket (sessionID,productID,quantity) values('$sessionID',$addProductID,1)";
	}else{ 
		 $sql = "update tb_basket set quantity=quantity+1 where  productID=$addProductID and sessionID='$sessionID'";
	}
}

$result= mysql_db_query($dbname,$sql);
if ($result) {
	header("Location: order.php");
	exit(0);
} else {
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);


?>