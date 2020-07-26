<?php 
header("Content-Type: text/plain; charset=utf8");
session_start();
include ("config.inc");	// เรียกไฟล์สำหรับจัดการเชื่อมต่อฐานข้อมูล MySQL
$sessionID= session_id();	// ฟังก์ชัน session_id เพื่อดึงค่า session ปัจจุบันมาเก็บไว้ในตัวแปร $sessionID
$removeProductID = $_GET['productID'];	// เก็บค่ารหัสสินค้าไว้ในตัวแปร $removeProductID
if ($removeProductID>0){	// ถ้ามีสินค้าในตะกร้า ให้ทำการเรียก sql Delete เพื่อลบสินค้าออกจากตะกร้า
	$sql = "Delete from tb_basket where sessionID='$sessionID' and productID=$removeProductID";
	mysqli_query($link,$sql);
}
echo"<form id='form1' name='form1' method='get'>";
// ดึงข้อมูลรายการสินค้าออกจากตะกร้า
$sql = "select productID,productname,price,quantity from tb_basket,tb_product where tb_basket.productID=tb_product.ID and  tb_basket.sessionID='$sessionID'";
$result = mysqli_query($link,$sql);
$totalPrice=0;
echo "<b>ตะกร้าสินค้า</b><p>";
echo "<table border=1>";
echo "<tr>
			<td>ชื่อสินค้า</td>
			<td>ราคา (บาท)</td>
			<td>จำนวน (รายการ)</td>
			<td>ราคารวม (บาท)</td>
			<td>คลิก Remove สินค้าออกจากตะกร้า</td>
		</tr>";
	while($row=mysqli_fetch_array($result)){	// วนลูปเพื่อดึงรายการสินค้ามาแสดง
	$addProductID = $row["productID"]; // เก็บรหัสสินค้าไว้ในตัวแปร $addproductID 	
	$productName = $row["productName"]; // เก็บชื่อสินค้าไว้ในตัวแปร $productName 
	$productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice 
	$quantity = $row["quantity"]; // เก็บจำนวนสินค้าไว้ในตัวแปร $quantity 
	echo "<td>$productName</td><td>$productPrice</td>";
	echo "<td>$quantity</td>";
	echo "<td align='right'>".($productPrice*$quantity)."</td>";	// คำนวนราคาสินค้ารวม = ราคา * จำนวนสินค้า
	// คลิกลิงค์ Reove เพื่อเอาสินค้าออกจากตะกร้า โดยเรียกฟังก์ชัน removeBasket   
	echo "<td><a href='#' onclick='removeBasket($addProductID, orders)'>Remove</a></td>";
	echo "</tr>";
	$totalPrice = $totalPrice + ($productPrice*$quantity);	// คำนวณราคาสุทธิ = ราคาสุทธิ + (ราคาสินค้า * จำนวนสินค้า)
}
echo "<tr>";
echo "<td colspan=4 align='right'><b>ราคาสุทธิ $totalPrice บาท</b></td></tr>";	// แสดงราคาสินค้าสุทธิ
echo "</table></form>";
?>