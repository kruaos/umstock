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


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body> 
<?php 
include "../config/navmenu.php";
?>


<div class="container" style="margin-top:30px">
  <div class="row">
  <div class="col-md-12">


    <h1>รายงานพัสดุ</h1>
            
   <?php
  include "../config/connect.php";
  $sql = "select * from tb_product where statusproduct='0' order by productname ;"; // ดึงข้อมูลจากตาราง product
  $result = mysql_db_query($dbname, $sql);
  ?>
    <table width='100%' class="table table-hover table-sm small"><tr class='text-center'>
      <th width='10%'><b>ลำดับ</b></th>
      <th width='30%'><b>ชื่อพัสดุ</b></th>
      <th width='20%'><b>บัญชี/ โครงการ</b></th>
      <th width='10%'><b>ราคา</b></th>
      <th width='10%'><b>จำนวน</b></th>
          </tr>
    
    <?php
    while ($row = mysql_fetch_array($result)) {
      $productID = $row["id"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $productName = $row["productName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
      $categoryID = $row["categoryID"];
      $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 ";
      $result2 = mysql_db_query($dbname, $sql2);
      while ($row2 = mysql_fetch_array($result2)) {
        $sumamo = number_format($row2["sumamo"]);
        if ($sumamo == 0) {
          $showdanger = 'alert alert-danger';
        } else if ($sumamo <= 2) {
          $showdanger = 'alert alert-warning ';
        } else {
          $showdanger = '';
        }
        ?>
    <tr class='text-center <?= $showdanger; ?>'>
      <td ><?php echo $num = $num + 1; ?></td>
      <td class="text-left" ><?php 
                            echo "<a href='orderdetail.php?productid=" . $productID . "'>" . $productName . "</a>";
                            ?></td>
      <td>
      <?php 
      $sqlcate = "select * from tb_category where categoryID='$categoryID';"; // ดึงข้อมูลจากตาราง product
      $resultcate = mysql_db_query($dbname, $sqlcate);
      while ($rowcate = mysql_fetch_array($resultcate)) {
        $categoryName = $rowcate["categoryName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      }
      if ($categoryID == 0) {
        echo ' ';
      } else {
        echo $categoryName;
      }
      ?>
      </td>
      <td><?= $productPrice ?></td>
      <td>
      <?php
      if ($sumamo == 0) {
        echo "หมด";

      } else if ($sumamo <= 2) {
        echo $sumamo . " <span class='badge badge-danger'>เหลือน้อย</span> ";
      } else {
        echo $sumamo;
      }
    }
    ?> 
      
      </td>
 
    </tr>

      <?
    } ?>
        <table>
        <?
        mysql_close($Conn);
        ?>
   

    </div>
  </div>
  </div>
<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>
</body>
</html>
