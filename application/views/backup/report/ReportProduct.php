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
           
   <?php
  include "../config/connect.php";
  $categoryID=$_GET['categoryID']; 
  if($categoryID==null){
    $sql = "select * from tb_product where statusproduct='0' order by productname ;"; 
  }else{
    $sql = "select * from tb_product where statusproduct='0' and categoryID=$categoryID order by productname ;"; 
  }
  $result = mysql_db_query($dbname, $sql);
  $sqlcate = "select * from tb_category where categoryID='$categoryID';"; // ดึงข้อมูลจากตาราง product
  $resultcate = mysql_db_query($dbname, $sqlcate);
  while ($rowcate = mysql_fetch_array($resultcate)) {
    $categoryName = $rowcate["categoryName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
  }
  ?>
  <h1>รายงานพัสดุ บัญชี <?=$categoryName;?></h1>     
    <table width='100%' class="table table-hover table-sm small"><tr class='text-center'>
          <th width='5%'><b>ลำดับ</b></th>
          <th width='20%'><b>ชื่อพัสดุ</b></th>
          <th width='10%'><b>ราคา</b></th>
          <th width='10%'><b>รับ</b></th>
          <th width='10%'><b>จ่าย</b></th>
          <th width='10%'><b>คงเหลือ</b></th>
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
                            echo "<a href='ReportDetail.php?productid=".$productID ."&categoryID=".$categoryID."'>" . $productName . "</a>";
                            ?></td>
 
    <td ><?= number_format($productPrice)." บาท"; ?></td>
          <td class='text-right'>
          <?php 
          $sql8 = "select SUM(a.amount*b.price)as'sumin' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and (a.statusOrder='in' or a.statusOrder='am') and a.productid=$productID and a.categoryID=$categoryID and a.statusfile=0";
          $result8 = mysql_db_query($dbname, $sql8);
          $row8 = mysql_fetch_array($result8);
          echo $sumin=number_format($row8['sumin']);
          ?>          
          </td>
          <td class='text-right'>
          <?php 
          $sql9 = "select SUM(a.amount*b.price)as'sumout' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and a.statusOrder='ou' and a.productid=$productID and a.categoryID=$categoryID and a.statusfile=0"; 
          $result9 = mysql_db_query($dbname, $sql9);
          $row9 = mysql_fetch_array($result9);
          echo  $sumout = number_format(abs($row9['sumout']));
          ?>          
          </td>
          <td>
          <?php
          if ($sumamo == 0) {
            echo " <span class='badge badge-danger'>หมด</span>";
          } else {
            echo $sumamo;
          }
        }
        ?> 
          </td>
          <td  class='text-right'>
          <?php 
          $suminall=$suminall+$row8['sumin'];
          $sumoutall=$sumoutall+$row9['sumout'];
          echo   number_format($row8['sumin']-abs($row9['sumout']));
          ?>          
          </td>
    </tr>

      <?
    } ?>
      <tr class='text-center'>
            <td ></td>
            <td >รวม</td>
            <td ></td>
            <td  class='text-right'><?= number_format($suminall);?></td>
            <td  class='text-right'><?= number_format(abs($sumoutall));?></td>
            <td ></td>
            <td  class='text-right'><?= number_format($suminall+$sumoutall);?></td>
          </tr>
        </table>
        <?
        mysql_close($Conn);
        ?>
   
   <a href="CategoryReport.php" id="non-printable" class="btn btn-danger  col-md">ย้อนกลับ</a>

    </div>
  </div>
  </div>
<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>
</body>
</html>
