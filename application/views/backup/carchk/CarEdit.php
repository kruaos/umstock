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
include "../config/connect.php";

  $categoryID=$_GET['categoryID'];
  $numc = 0;
?>
<div class="container small"  style="margin-top:30px">
<div class="row ">
    <div class="col-md ">  
        <form method='post' action="caradd.php">
        <h1>ทำรายการรถ เพิ่ม/ลด</h1>
     <div class="form-row">
          <div class="form-group col-md-3 col-sm-4">
            <label >ยี่ห้อรถยนต์</label>
            <input type="text" class="form-control"  name='carBrand' class="form-control" id="text">
          </div>
          <div class="form-group col-md-2 col-sm-4">
            <label >แบบของรถรุ่น</label>
            <input type="text" class="form-control"  name='CarNumber' class="form-control" id="text">
          </div>
          <div class="form-group col-md-2 col-sm-4">
            <label >แรงม้า</label>
            <input type="text" class="form-control"  name='Hpower' class="form-control" id="text">
          </div>
          <div class="form-group col-md-2 col-sm-4">
            <label >จำนวนลูกสูบ</label>
            <input type="text" class="form-control"  name='piston' class="form-control" id="text">
          </div>
          <div class="form-group col-md-3 col-sm-8">
            <label >ผู้รับผิดชอบรักษารถยนต์</label>
            <select class="form-control" name='CarCusID'>
        <?php
        $sql = "select * from tb_customer where status='1'  order by cusid;"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname, $sql);

        while ($row = mysql_fetch_array($result)) {
          $customerName = $row["fullname"];
          $cusid = $row["cusid"];
          echo "<option value='" . $cusid . "'> [" . $cusid . '] ' . $customerName . "</option>";
        }
        ?>
        </select> 
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <label >วันที่ได้รับกรรมสิทธิ์</label>
            <input name='carCreateDate'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <label >วันที่หมดกรรมสิทธิ์</label>
            <input name='carEndDate'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label >ปริมาณน้ำมัน 1 ลิตร/กม.</label>
            <input type="text" class="form-control"  placeholder="ลิตร"  name='midePerKM' class="form-control" id="text">
          </div>

        </div>
        <div class="form-row">
          <div class="form-group col-md col-sm">
            <a class="btn btn-danger  btn-block" href='order.php'>ย้อนกลับ</a>
          </div>
          <div class="form-group col-md col-sm">
           <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
          </div>
        </FORM>
      </div>
</div>
</div>

        <?
        mysql_close($Conn);

        ?>

  <div class="text-center" style="margin-bottom:0">
    <p>:: สำนักงานเทศบาลตำบลอุโมงค์ 2019 ::</p>
  </div>
</body>
</html>
