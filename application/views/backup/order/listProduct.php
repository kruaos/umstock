<?php
include "../config/connect.php"; // เรียกไฟล์สำหรับจัดการเชื่อมต่อฐานข้อมูล MySQL
$sql = "select * from tb_product;"; // ดึงข้อมูลจากตาราง product
$result = mysql_db_query($dbname,$sql);
echo "<table border='1'><tr align='center'>
	<td width=300><b>ชื่อสินค้า</b></td>
	<td width=300><b>ราคา</b></td>
	<td width=300><b>คลิกเลือกซื้อสินค้า</b>
	</td></tr>";

// วนลูปดึงข้อมูลจากตาราง product
while($row = mysql_fetch_array($result)){ 
	$productID = $row["id"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
	$productName = $row["name"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
	$productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice

	// คลิกลิงค์ Add to Cart เพื่อเก็บสินค้าลงตะกร้า โดยเรียกฟังก์ชัน DisplayBasket   
	echo "<tr>" .
		  "<td><center>$productName</center></td>" .
		  "<td><center>$productPrice</center></td>" .
		  "<td><center>" .
		  "<a href='#' onclick='DisplayBasket($productID, orders)'>" .
		  "เพิ่มรายการ</center></a></td></tr>";
}
echo "<table>";
mysql_close($Conn);
?>