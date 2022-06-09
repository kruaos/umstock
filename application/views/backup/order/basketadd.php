<?
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
include "../member/chksession.php";

$memberID=$_SESSION[sess_memberID];
$productID=$_GET['productID'];	
$categoryID=$_GET['categoryID'];	
$pagein=$_GET['pagein'];	
$pageout=$_GET['pageout'];		



$sql1 = "select count(basketID) as 'countid' from tb_basket where productID=$productID and memberID=$memberID";
$result = mysql_db_query($dbname,$sql1);
while($row = mysql_fetch_array($result)){ 
	if($row['countid']==0){ 
		 $sql = "insert into tb_basket (memberID,productID,quantity) values($memberID,$productID,1)";
	}else{ 
		 $sql = "update tb_basket set quantity=quantity+1 where  productID=$productID and memberID=$memberID";
	}
}
$result= mysql_db_query($dbname,$sql);
if ($result) {
	//echo $sql;
	header("Location: basket.php?categoryID=$categoryID&pagein=$pagein&pageout=$pageout");
	exit(0);
} else {
	echo $sql1;
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);
?>