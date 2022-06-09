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
<link href="../config/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="../config/dist/js/bootstrap-datepicker-custom.js"></script>
<script src="../config/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true              //Set เป็นปี พ.ศ.
        }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
    });
</script>


  <style>
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  </style>
</head>
<body>
 <?php 
include "../config/navmenu.php";
if($_GET['categoryID']==null){
?>
 <?php
    include "../config/connect.php";
    $sql = "select * from tb_category where catestatus='0';"; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
    <table class="table table-hover  table-sm " ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='30%'><b>บัญชี/โครงการ</b></th>
          <th width='20%'><b>แผนงาน</b></th>
          <th width='30%'><b>หน่วยรับผิดชอบ</b></th>
        </tr>

    <?php
    while ($row = mysql_fetch_array($result)) {
      $categoryID = $row["categoryID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $categoryName = $row["categoryName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $planID = $row["planID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

      ?>
    <tr>
      <td><?php 
          $num = $num + 1;
          echo $num;
          ?></td>
      <td><a href="basket.php?categoryID=<?php echo $categoryID;?>"><?= $categoryName ?></a></td>
      <td>
      <?php
      $sql9 = "select * from tb_plan where planid='$planID' ;"; // ดึงข้อมูลจากตาราง product
      $result9 = mysql_db_query($dbname, $sql9);

      while ($row9 = mysql_fetch_array($result9)) {
        $planname = $row9["planname"];
        $planid = $row9["planid"];
        $deparmentID = $row9["deparmentID"];
      }
      if($planID==0){
        echo '';
      }else{
        echo $planname;
      }
      ?>
      </td>
      <td>
      <?php 

          $sql4 = "select * from tb_department where departmentID=$deparmentID and statusDepa='3' order by departmentID;"; // ดึงข้อมูลจากตาราง product
          $result4 = mysql_db_query($dbname, $sql4);
          while ($row4 = mysql_fetch_array($result4)) {
            $departmentName = $row4["departmentName"];
            $rootDepaID = $row4['rootDepaID'];

            $sql5 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
            $result5 = mysql_db_query($dbname, $sql5);

            while ($row5 = mysql_fetch_array($result5)) {
              $rootDepaName = $row5["departmentName"];
              $subDepaID = $row5['rootDepaID'];

              $sql6 = "select * from tb_department where departmentID='$subDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
              $result6 = mysql_db_query($dbname, $sql6);

              while ($row6 = mysql_fetch_array($result6)) {
                $subDepaName = $row6["departmentName"];
              }
              if($planID==0){
                echo '';
              }else{
                echo "งาน" . $departmentName . " [ ฝ่าย" . $rootDepaName . " - " . $subDepaName . " ]";
              }
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
    <div class="col-md-1"></div>
  </div>
</div>
<?php 
}else{
  $categoryID=$_GET['categoryID'];
  $numc = 0;
?>
<div class="container small"  style="margin-top:30px">
<div class="row ">
    <div class="col-md ">  
        <form method='post' action="../order/basketorderadd.php">
        <h1>ทำรายการเบิกพัสดุ</h1>
  <div class="form-row">
    <div class="form-group col-md-2">
      <label >วันที่</label>
      <input name='dateOrder'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
    </div>
    <div class="form-group col-md">
        <label >บัญชี / โครงการ </label>
      <select class="form-control"  name='categoryID'>
        <?php
      include "../config/connect.php";
        $sql3 = "select * from tb_category where categoryID=$categoryID;"; // ดึงข้อมูลจากตาราง product
        $result3 = mysql_db_query($dbname, $sql3);
        while ($row3 = mysql_fetch_array($result3)) {
          $categoryID = $row3["categoryID"];
          $categoryName = $row3["categoryName"];
          echo "<option value='" . $categoryID . "'>" . $categoryName . "</option>";
        }
        ?>
        </select>
    </div>
    <div class="form-group col-md">
    <label>จ่าย </label>
      <select class="form-control"  name='cusid'>
      <?php
      $sql = "select * from tb_customer where cusid=$sess_memberid"; // ดึงข้อมูลจากตาราง product
      $result = mysql_db_query($dbname, $sql);
      while ($row = mysql_fetch_array($result)) {
        $customerName = $row["fullname"];
        $cusid = $row["cusid"];
        echo "<option value='" . $cusid . "'> [" . $cusid . '] ' . $customerName . "</option>";
      }
      ?>
      </select>    
    </div>
    <div class="form-group col-md-2">
      <label >ต้องการภายในวันที่</label>
      <input name='dayneed'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
    </div>
    
    <div class="form-group col-md-12">
      <label >รายละเอียด</label>
      <input type="text" class="form-control"  placeholder="เพื่อ............" name='Explain' class="form-control" id="text">
    </div>
    <div class="form-group col-md">
        <a class="btn btn-danger  btn-block" href='basket.php'>ย้อนกลับ</a>
    </div>
    <div class="form-group col-md">
        <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
    </div>
    </FORM>
  </div>
</div>
</div>
<div class="row ">
    <div class="col-md ">    
    <?php
    $sql = "select * from tb_product "; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
          <table  class="table table-hover table-sm  ">
          <tr class='text-center  alert-success '>
          <th width='50'><b>No.</b></th>
            <th ><b>รายการพัสดุที่ต้องการ </b></th>
            <th width='30'>จำนวน </th>
            <th width='50'class='text-center'><b>เพิ่ม</b> </th>
          </tr>
             <?php
    $perpagein = 5;
    if (isset($_GET['pagein'])) {
      $pangin = $_GET['pagein'];
    } else {
      $pangin = 1;
    }
    if (isset($_GET['pageout'])) {
      $pageout = $_GET['pageout'];
    } else {
      $pageout = 1;
    }
    $startin = ($pangin - 1) * $perpagein;
    $sql = "select * from tb_product where statusproduct='0' and categoryID=$categoryID order by productname limit {$startin} , {$perpagein} ;";
    $result = mysql_db_query($dbname, $sql);
    while ($row = mysql_fetch_array($result)) {
      $productID = $row["id"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $productName = $row["productName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
      $categoryID = $row["categoryID"];
      $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 ";
      $result2 = mysql_db_query($dbname, $sql2);
              while ($row2 = mysql_fetch_array($result2)) {
                $sumamo = number_format($row2["sumamo"]);
                $sql4 = "select * from tb_basket where productID='$productID';";
                $result4 = mysql_db_query($dbname, $sql4);
                $basketamout = 0;
                while ($row4 = mysql_fetch_array($result4)) {
                  $basketamout = $row4["quantity"];
                }  ?>
                          <tr class='text-center'>
                            <td ><?php echo $startin = $startin + 1; ?></td>
                            <td class="text-left" ><?php echo $productName . " [ " . $productPrice . " บาท ]"; ?></td>
                            <td><?php $amountshow = $sumamo - $basketamout;
                                echo $amountshow; ?> </td>
                          <td>
                            <?php if ($sumamo > $basketamout) { ?>
                           <a href='basketadd.php?productID=<?php echo $productID.'&categoryID='.$categoryID.'&pagein='.$pangin.'&pageout='.$pageout;  ?>'>
                            <button type="button" class="btn btn-success btn-sm"><div class='small'>เพิ่ม</div></button>
                          </a>
                          <?php } else {
                                  ?>
                                  <button type="button" class="btn btn-danger btn-sm"><div class='small'>หมด</div></button>
                                  <?php
                             }; ?>
                          </td>
                          </tr>
          <?php     ?>
          <?
              }
            } 
 $sql2 = "select * from tb_product where statusproduct='0' and categoryID=$categoryID";
 $query2 = mysql_db_query($dbname, $sql2);
 $total_record = mysql_num_rows($query2);
 $total_pagein = ceil($total_record / $perpagein);
?>
                </table>
      <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="basket.php?categoryID=<?php echo $categoryID;?>&pagein=1&pageout=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <?php for($i1=1;$i1<=$total_pagein;$i1++){ ?>
          <li class="page-item"><a class="page-link" href="basket.php?categoryID=<?php echo $categoryID;?>&pagein=<?php echo $i1; ?>&pageout=<?php echo $pageout; ?>"><?php echo $i2; ?><?php echo $i1; ?></a></li>
          <?php } ?>
          <li class="page-item">
            <a class="page-link" href="basket.php?categoryID=<?php echo $categoryID;?>&pagein=<?php echo $total_pagein;?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
      </ul>
     
    </div>
    <div class="col-md ">
      <table class='table  table-hover table-sm '>
        <tr class='text-center alert-primary'>
            <th width='50'><b>No.</b></th>
            <th ><b>รายการเบิกพัสดุ </b></th>
            <th width='30'>จำนวน </th>
            <th width='50' ><b>ลด</b> </th>
        </tr>
<?php
    $perpageout = 5;
    $startout = ($pageout - 1) * $perpageout;

$sql1 = "SELECT tb_basket.*, tb_product.* FROM tb_basket,tb_product WHERE tb_product.id=tb_basket.productID 
          and tb_product.categoryID=$categoryID and tb_basket.memberID=$sess_memberid limit {$startout} , {$perpageout} ;"; 
$result1 = mysql_db_query($dbname, $sql1);
while ($row1 = mysql_fetch_array($result1)) {
  $id = $row1["id"];
  $productID1 = $row1["productID"];
  $memberID = $sess_memberid;
  $sql3 = "select * from tb_product where id=$productID1;"; 
  $result3 = mysql_db_query($dbname, $sql3);
  while ($row3 = mysql_fetch_array($result3)) {
    $detailBasket = $row3["productName"] . " [ " . $row3["price"] . " บาท ]";
  }
  $sumamout = $row1["quantity"];
  ?>
      <tr>
        <td><?php echo $startout = $startout + 1; ?></td>
        <td><?php echo $detailBasket; ?></td>
        <td class='text-center'><?php echo $sumamout; ?>   </td>
        <td class='text-center'>
        <a href='basketremove.php?addProductID=<?php echo $productID1.'&categoryID='.$categoryID.'&pagein='.$pangin.'&pageout='.$pageout;  ?>'>
        <button type="button" class="btn btn-warning btn-sm"><div class='small'>ลด</div></button>
      </a></td>
       </tr>
        <?
      } ?>
      </table>
<?php
      $sql7 = "SELECT tb_basket.*, tb_product.* FROM tb_basket,tb_product WHERE tb_product.id=tb_basket.productID 
      and tb_product.categoryID=$categoryID and tb_basket.memberID=$sess_memberid ";
 $query7 = mysql_db_query($dbname, $sql7);
 $total_record = mysql_num_rows($query7);
 $total_pageout = ceil($total_record / $perpageout);
?>
                </table>
      <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="basket.php?categoryID=<?php echo $categoryID;?>&pagein=<?php echo $pangin; ?>&pageout=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <?php for($i2=1;$i2<=$total_pageout;$i2++){ ?>
          <li class="page-item"><a class="page-link" href="basket.php?categoryID=<?php echo $categoryID;?>&pagein=<?php echo $pangin; ?>&pageout=<?php echo $i2; ?>"><?php echo $i2; ?></a></li>
          <?php } ?>
          <li class="page-item">
            <a class="page-link" href="basket.php?categoryID=<?php echo $categoryID;?>&pagein=<?php echo $total_pageout;?>&pageout=<?php echo $total_pageout;?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
      </ul>
    </div>
  </div>
   <?php
  mysql_close($Conn);
} 
  ?>

  <div class="text-center" style="margin-bottom:0">
    <p>:: สำนักงานเทศบาลตำบลอุโมงค์ 2019 ::</p>
  </div>
</body>
</html>
