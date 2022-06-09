<?php
include "config.inc"; // เรียกไฟล์สำหรับจัดการเชื่อมต่อฐานข้อมูล MySQL
$sql = "select * from tb_product;"; // ดึงข้อมูลจากตาราง product
$result = mysqli_query($link,$sql);
echo "<table border='1'><tr align='center'>
	<td><b>ชื่อสินค้า</b></td>
	<td><b>ราคา</b></td>
	<td><b>คลิกเลือกซื้อสินค้า</b>
	</td></tr>";

// วนลูปดึงข้อมูลจากตาราง product
while($row = mysqli_fetch_array($result)){ 
	$productID = $row["id"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
	$productName = $row["productName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
	$productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice

	// คลิกลิงค์ Add to Cart เพื่อเก็บสินค้าลงตะกร้า โดยเรียกฟังก์ชัน DisplayBasket   
	echo "<tr>" .
		  "<td><center>$productName</center></td>" .
		  "<td><center>$productPrice</center></td>" .
		  "<td><center>" .
		  "<a href='#' onclick='DisplayBasket($productID, orders)'>" .
		  "Add to Cart</center></a></td></tr>";
}
echo "<table>";
mysqli_close($link);
?>