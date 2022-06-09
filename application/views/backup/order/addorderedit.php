<?
include "../member/chksession.php";
date_default_timezone_set("Asia/Bangkok");
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

</head>
<body> 
<?php 
$idedit=$_GET['idedit'];
include "../config/navmenu.php";
include "../config/connect.php";
$sql1 = "select * from tb_orderfile where orderFileID=$idedit;"; // ดึงข้อมูลจากตาราง product
        $result1 = mysql_db_query($dbname, $sql1);
        while ($row1 = mysql_fetch_array($result1)) {
          $orderFileID=$row1['orderFileID'];
          $categoryID=$row1['categoryID'];
          $sellerID=$row1['sellerID'];
          $cusid=$row1['cusid'];
          $NumProductID=$row1['NumProductID'];
          $productID=$row1['productID'];
          $statusOrder=$row1['statusOrder'];
          $amount=$row1['amount'];
          $createdate=$row1['createdate'];
        }
        $YYcreatedate=substr($createdate,8,2)."/".substr($createdate,5,2)."/".(substr($createdate,0,4)+543);
?>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-xs-1"></div>
    <div class="col-sm-12 col-md-12 col-xs-12">
    <h1>เพิ่มรายการบัญชีพัสดุ</h1>

<form method='post' action="../order/addorderupdate.php">

  <div class="form-row">
  <div class="form-group col-md-2">
      <label for="inputEmail4">วันที่</label>
      <input type='hidden' name='orderFileID' class="form-control " value='<?php echo $orderFileID;?>'> 
      <input class="form-control " value='<?php echo $YYcreatedate;?>' disabled> 
    </div>
    <div class="form-group col-md-4">
          <label >บัญชี / โครงการ </label>
      <select class="form-control" " name='categoryID'>
        <?php
        $sql3 = "select * from tb_category where categoryID=$categoryID ;"; // ดึงข้อมูลจากตาราง product
        $result3 = mysql_db_query($dbname, $sql3);
        
        while ($row3 = mysql_fetch_array($result3)) {
          $categoryID = $row3["categoryID"];
          $categoryName = $row3["categoryName"];
          echo "<option value='" . $categoryID . "'>" . $categoryName . "</option>";
        }
        ?>
        </select>

    </div>
        <div class="form-group col-md-3">
              <label for="inputEmail4">รับ </label>
    
          <select class="form-control"  name='sellerID'>
            <?php
            $sql4 = "select * from tb_seller where  sellerID=$sellerID;"; // ดึงข้อมูลจากตาราง product
            $result4 = mysql_db_query($dbname, $sql4);
    
            while ($row4 = mysql_fetch_array($result4)) {
              $sellerID = $row4["sellerID"];
              $sellerName = $row4["sellerName"];
              echo "<option value='" . $sellerID . "'>" . $sellerName . "</option>";
            }
            ?>
            </select>
        </div>

    <div class="form-group col-md-3">
      <label for="inputPassword4">จ่าย </label>

        <select class="form-control" id="sel1" name='cusid'>
        <?php
        $sqlf = "select * from tb_customer where cusid=$cusid;"; // ดึงข้อมูลจากตาราง product
        $resultf = mysql_db_query($dbname, $sqlf);

        while ($rowf = mysql_fetch_array($resultf)) {
          $customerName = $rowf["fullname"];
          $cusid = $rowf["cusid"];
          echo "<option value='". $cusid ."'> [" . $cusid . '] ' . $customerName . "</option>";
        }
        ?>
        </select>    </div>
  </div>
  <div class="form-row ">
  <div class="form-group col-md-4">
    <label for="inputAddress">เลขใบรับพัสดุ</label>
    <input type="text" class="form-control" name='NumProductID' class="form-control" id="text" value='<?php echo $NumProductID;?>'>
  </div>

    <div class="form-group col-md-4">
      <label >พัสดุ </label> 
      <select class="form-control" id="sel1" name='productID'>
          <?php
          $sqlp = "select * from tb_product "; // ดึงข้อมูลจากตาราง product
          $resultp = mysql_db_query($dbname, $sqlp);

          while ($rowp = mysql_fetch_array($resultp)) {
            $productName = $rowp["productName"];
            $productprice = $rowp["price"];
            if ($rowp["id"]==$productID){ $showPD="selected"; }else{$showPD=" ";}
            echo "<option value='".$rowp['id']."' $showPD>" . $productName . " [" . $productprice . " บาท]" . "</option>";
          }
          ?>
          </select>    </div>
    <div class="form-group col-md-2">
      <label >สถานะ</label>
      <select class="form-control" id="sel1" name='statusOrder'>
      
        <option value='in' <?php if ($statusOrder=='in'){echo "selected"; }?>>รับ</option>
        <option value='ou' <?php if ($statusOrder=='ou'){echo "selected"; }?>>จ่าย</option>
        <option value='am' <?php if ($statusOrder=='am'){echo "selected"; }?>>ยอดยกมา</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">จำนวน</label>
      <input type="text" name='amount' class="form-control css-require"  value="<?php echo abs($amount);?>" >
          </div>

  <div class="form-row col-md-12">
              <div class="form-group col-md-6">
<a class="btn btn-danger  btn-block" href="addorder.php?categoryID=<?php echo $categoryID?>">ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
  <button type="submit" class="btn btn-warning col-md">บันทึกรายการ</button>
              </div>
          </FORM>
            </div>
        <?
        mysql_close($Conn);
 
        ?>
    </div>
    <div class="col-sx-1"></div>
  </div>
</div>
<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
