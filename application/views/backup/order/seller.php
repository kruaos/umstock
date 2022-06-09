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
?>


<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
    <h1>เพิ่ม ร้านค้า</h1>


	<FORM method='post'class="form-inline" ACTION="selleradd.php" >
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width='50%'>ชื่อ ร้านค้า</th>
        <th width='50%'>ที่อยู่</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ชื่อ ร้านค้า" 
          name="sellerName">
        </td>
        <td>      
        <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ที่อยู่ร้านค้า " 
          name="sellerAddress" >
          
        </td>
      </tr>
    </tbody>
  </table>      
     <div class="form-row col-md-12">
              <div class="form-group col-md-6">
              <a class="btn btn-danger  btn-block" href='addorder.php'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
              </div>
          </FORM>
            </div>
    <?php
    include "../config/connect.php";
    $sql = "select * from tb_seller where sellerStatus<>'0';"; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
    <table class="table table-hover" ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='30%'><b>ชื่อร ้านค้า </b></th>
          <th width='20%'><b>ที่อยู่</b></th>
          <th width='15%'><b>แก้ไข</b></th>
        </tr>

    <?php
    while ($row = mysql_fetch_array($result)) {
      $sellerID = $row["sellerID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $sellerName = $row["sellerName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $sellerAddress = $row["sellerAddress"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

      ?>
    <tr>
      <td><?php 
          $num = $num + 1;
          echo $num;
          ?></td>
      <td><?= $sellerName ?></td>
      <td><?= $sellerAddress ?></td>
      <td><a href='selleredit.php?sellerID=<?= $sellerID ?>'>แก้ไข </a>|<a href='sellerdel.php?sellerID=<?= $sellerID ?>'> ยกเลิก</a></center></td>
      
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

<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
