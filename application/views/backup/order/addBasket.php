<?php
header("Content-Type: text/plain; charset=utf8");
echo"<form id='form1' name='form1' method='post'>";
include "../config/connect.php";
$memberID=$_GET['memberID'];
$addProductID=$_GET['productID'];	
$sql = "select ID from tb_basket where productID=$addProductID and memberID='$memberID'";
$result = mysql_db_query($dbname,$sql);

if(mysql_num_rows($result)==0){ 
	$sql = "insert into tb_basket (memberID,productID,quantity) values('$memberID',$addProductID,1)";
}else{
	$sql = "update tb_basket set quantity=quantity+1 where  productID=$addProductID and memberID='$memberID'";
}
mysql_db_query($dbname,$sql);
$sql = "select productID,name,price,quantity from tb_basket,tb_product where tb_basket.productID=tb_product.ID and memberID='$memberID'";
$result = mysql_db_query($dbname,$sql);
$totalPrice=0;
echo "<b>ตะกร้าสินค้า</b><p>";
echo"<table border=1>";
echo "<tr>
			<td>ชื่อสินค้า</td>
			<td>ราคา (บาท)</td>
			<td>จำนวน (รายการ)</td>
			<td>ราคารวม (บาท)</td>
			<td>คลิก Remove สินค้าออกจากตะกร้า</td>
		</tr>";
while($row=mysql_fetch_array($result)){	
	$addProductID = $row["productID"];  
	$productName = $row["name"];	
	$productPrice = $row["price"];	
	$quantity = $row["quantity"];	
	echo "<tr>";
	echo "<td>$productName</td><td>$productPrice</td>";
	echo "<td>$quantity</td>";
	echo "<td>".($productPrice*$quantity)."</td>";	// คำนวนราคาสินค้ารวม = ราคา * จำนวนสินค้า
	echo "<td><a href='#' onclick='removeBasket($addProductID, orders)'>Remove</a></td>";
	echo "</tr>";
	$totalPrice = $totalPrice + ($productPrice*$quantity);	// คำนวณราคาสุทธิ = ราคาสุทธิ + (ราคาสินค้า * จำนวนสินค้า)
}
	echo "<tr>";
	echo "<td colspan=4 align='right'><b>ราคาสุทธิ $totalPrice บาท</b></td></tr>";	 // แสดงราคาสินค้าสุทธิ
echo "</table>";
mysql_close($Conn);

?>