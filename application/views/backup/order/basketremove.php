<?
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
include "../member/chksession.php";

$memberID=$_SESSION[sess_memberID];
$addProductID=$_GET['addProductID'];
$categoryID=$_GET['categoryID'];	
$pagein=$_GET['pagein'];	
$pageout=$_GET['pageout'];	

$sql1 = "select quantity from tb_basket where productID=$addProductID and memberID='$memberID'";
$result = mysql_db_query($dbname,$sql1);
while($row = mysql_fetch_array($result)){ 
	if($row['quantity']==1){ // ถ้าไม่มีสินค้าในตะกร้าเลยให้เรียก sql insert เพื่อเก็บรายการสินค้าลงตาราง basket
		$sql = "DELETE FROM tb_basket where  productID=$addProductID and memberID='$memberID'";
	}else{ 
		$sql = "update tb_basket set quantity=quantity-1 where productID=$addProductID and memberID='$memberID'";
	}
}
$result1 = mysql_db_query($dbname,$sql);
if ($result1) {
	//echo $sql;
	header("Location: basket.php?categoryID=$categoryID&pagein=$pagein&pageout=$pageout");
	exit(0);
} else {
	echo $sql1."<br>";
	echo $sql;
	header("Location: basket.php?categoryID=$categoryID&pagein=$pagein&pageout=$pageout");
	echo "<h3>บันทึกล้มเหลว</h3>";
}
mysql_close($Conn);

?>