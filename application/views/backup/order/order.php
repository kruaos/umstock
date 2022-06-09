<?
include "../member/chksession.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>UMStock</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <style>
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  </style>
</head>
<body> 
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
 <h3 class="text-muted"><a href ='..\main.php'>UMStock</a></h3>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        ข้อมูลส่วนตัว
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="edit.php">แก้ไขข้อมูลส่วนตัว</a>
        <a class="dropdown-item" href="changepw.php">เปลี่ยนรหัสผ่าน</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        ทำรายการพัสดุ
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="order.php" >ทำรายการเบิกพัสดุ</a>
        <a class="dropdown-item" href="#" >เพิ่มหมวดหรือเพิ่มพัสดุ</a>
        <a class="dropdown-item" href="#" >พิมพ์ใบเบิกพัสดุ</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        ทำรายการเจ้าหน้าที่
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#" >กำหนดสิทธิ</a>
        <a class="dropdown-item" href="#" >อนุมัติคำขอ</a>
        <a class="dropdown-item" href="#" >แก้ไขรายการ</a>
      </div>
    </li>
   
      <li class="nav-item">
        <a class="nav-link" href="logout.php">ออกจากระบบ</a>
      </li>    
    </ul>
  </div>  
</nav>






<div class="container-fluid" style="margin-top:30px">
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <p class="alert alert-primary" role="alert">รายการเบิกพัสดุ </p> 
  <table class='table  table-hover'><tr>
            <th width=5%><b>ลำดับ</b></th>
            <th width=40%><b>รายการ </b></th>
            <th width=10%>จำนวน </th>
            <th width=15%><b>หมายเหตุ</b>
            </th></tr>
            <?php
          $numc=0;              
          include "../config/connect.php";  // เรียกไฟล์สำหรับจัดการเชื่อมต่อฐานข้อมูล MySQL
          $sql1 = "select * from tb_basket;"; // ดึงข้อมูลจากตาราง product
          $result1 = mysql_db_query($dbname,$sql1);
                  
          while($row1 = mysqli_fetch_array($result1)){ 
            $id = $row1["id"];	 
            $productID1 = $row1["productID"]; 
            $getsession=$row1["sessionID"];
            $sql3 = "select * from tb_product where id=$productID1;"; // ดึงข้อมูลจากตาราง product
            $result3 = mysql_db_query($dbname,$sql3);
                  while($row3 = mysql_fetch_array($result3)){ 
                    $detailBasket = $row3["productName"]."(".$row3["price"]." บาท )"; 
                  }
            $sumamout = $row1["quantity"]; 
      ?>
      <tr>
        <td><?php echo $numc=$numc+1;?></td>
        <td><?php echo $detailBasket;?></td>
        <td><?php echo $sumamout; ?>   </td>
        <td><a href='orderremove.php?addProductID=<?php echo $productID1;?>'>ลดรายการ</a></td></tr>
        <?    } ?>
      <table>
      <a href='#'class='btn btn-success'>ส่งคำขอ</a><a href='orderclear.php?getsession=<?=$getsession?>' class='btn btn-danger'>ยกเลิก</a>
    </div>
</div>

<div class="row ">
    <div class="col-sm-12 ">
      <?php
        $sql = "select * from tb_product;"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname,$sql);
        ?>
        <p class="alert alert-success " role="alert">เลือกรายการพัสดุที่ต้องการ</p>
    <table class='table  table-hover'><tr>
          <th width=20%><b>ชื่อสินค้า</b></th>
          <th width=20%><b>ราคา</b></th>
          <th width=20%>จำนวน</th>
          <th width=20%><b>คลิกเลือกซื้อสินค้า</b>
          </th></tr>

    <?php
        while($row = mysqli_fetch_array($result)){ 
          $productID = $row["id"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
          $productName = $row["productName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
          $productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
    ?>
    <tr>
      <td><?=$productName?></td>
      <td><?=$productPrice?></td>
      <td>            <?php
        $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID"; 
        $result2 = mysql_db_query($dbname,$sql2);
        while($row2 = mysql_fetch_array($result2)){ 
          $sumamo=number_format($row2["sumamo"]);
          if ($sumamo==0){
            echo "หมด";
          }else{
            echo $sumamo;
          }
        }
        ?>   </td>
      <td><a href='orderadd.php?addProductID=<?php echo $productID;?>' >เพิ่มรายการ</a></td></tr>

      <?    } ?>
        <table>
        <? 
        mysql_close($Conn);
        ?>
    </div>
    
  </div>
  </div>

  <div class="text-center" style="margin-bottom:0">
    <p>:: สำนักงานเทศบาลตำบลอุโมงค์ 2019 ::</p>
  </div>
</body>
</html>
