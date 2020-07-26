<?php
header("Content-Type: text/plain; charset=utf8");
session_start();
echo"<form id='form1' name='form1' method='post'>";
include ("config.inc");	// เรียกไฟล์สำหรับจัดการเชื่อมต่อฐานข้อมูล MySQL
$sessionID= session_id();	// ฟังก์ชัน session_id เพื่อดึงค่า session ปัจจุบันมาเก็บไว้ในตัวแปร $sessionID
$addProductID=$_GET['productID'];	// เก็บค่ารหัสสินค้าไว้ในตัวแปร $addProductID
// ดึงรหัสสินค้าจากตาราง basket ตามเงื่อนไขรหัสสินค้า และค่า session
$sql = "select ID from tb_basket where productID=$addProductID and sessionID='$sessionID'";
$result = mysqli_query($link,$sql);
// ตรวจสอบว่ามีจำนวนเรคคอร์ดหรือไม่
if(mysqli_num_rows($result)==0){ // ถ้าไม่มีสินค้าในตะกร้าเลยให้เรียก sql insert เพื่อเก็บรายการสินค้าลงตาราง basket
	$sql = "insert into tb_basket (sessionID,productID,quantity) values('$sessionID',$addProductID,1)";
}else{ // ถ้ามีสินค้าในตะกร้าให้เรียก sql update เพื่อปรับปรุงจำนวนสินค้าในตาราง basket
	$sql = "update tb_basket set quantity=quantity+1 where  productID=$addProductID and sessionID='$sessionID'";
}
mysqli_query($link,$sql);
// แสดงรายการสินค้าในตะกร้า
$sql = "select productID,productname,price,quantity from tb_basket,tb_product where tb_basket.productID=tb_product.ID and 
tb_basket.sessionID='$sessionID'";
$result = mysqli_query($link,$sql);
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
while($row=mysqli_fetch_array($result)){	// วนลูปเพื่อดึงรายการสินค้าจากตะกร้า
	$addProductID = $row["productID"]; // เก็บรหัสสินค้าไว้ในตัวแปร $addproductID 
	$productName = $row["name"];	// เก็บชื่อสินค้าไว้ในตัวแปร $productName
	$productPrice = $row["price"];	// เก็บราคาสินค้าไว้ในตัวแปร $productPrice
	$quantity = $row["quantity"];	// เก็บจำนวนสินค้าไว้ในตัวแปร $quantity
	echo "<tr>";
	echo "<td>$productName</td><td>$productPrice</td>";
	echo "<td>$quantity</td>";
	echo "<td>".($productPrice*$quantity)."</td>";	// คำนวนราคาสินค้ารวม = ราคา * จำนวนสินค้า
	// คลิกลิงค์ Reove เพื่อเอาสินค้าออกจากตะกร้า โดยเรียกฟังก์ชัน removeBasket   
	echo "<td><a href='#' onclick='removeBasket($addProductID, orders)'>Remove</a></td>";
	echo "</tr>";
	$totalPrice = $totalPrice + ($productPrice*$quantity);	// คำนวณราคาสุทธิ = ราคาสุทธิ + (ราคาสินค้า * จำนวนสินค้า)
}
	echo "<tr>";
	echo "<td colspan=4 align='right'><b>ราคาสุทธิ $totalPrice บาท</b></td></tr>";	 // แสดงราคาสินค้าสุทธิ
echo "</table>";
?>