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
  $categoryID=$_GET['categoryID'];
  $numc = 0;
?>
<div class="container small"  style="margin-top:30px">
<div class="row ">
    <div class="col-md ">  
        <form method='post' action="../order/basketorderadd.php">
        <h1>ทำรายการเบิกน้ำมัน</h1>
     <div class="form-row">
     <div class="form-group col-md-3 col-sm-6">
         <label >วันที่</label>
         <input name='dateOrder'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
         </div>
         <div class="form-group col-md-3 col-sm-6">
            <label >รถ/ เครืองยน <a href="car.php">[เพิ่มรถ]</a></label>
            <select class="form-control"  name='carID'>
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
          <div class="form-group col-md-3 col-sm-6">
          <label>ประเภทเชื้อเพลิง</label>
            <select class="form-control"  name='cusid'>
              <option value='1'>ไบโอดีเซล</option>
              <option value='2'>เบนซิน</option>
              <option value='3'>ดีเซล</option>
              <option value='4'>อื่นๆ</option>
            </select>    
          </div>
        <div class="form-group col-md-3 col-sm-6 ">
          <label >จำนวน</label>
          <input type="text" class="form-control"  placeholder="ลิตร" name='Explain' class="form-control" id="text">
          </div>
          <div class="form-group col-md-6 col-sm-6">
          <label >ระยะ กม./ไมค์ เมื่อขอเบิก</label>
          <input type="text" class="form-control"   name='Explain' class="form-control" id="text">
          </div>
          <div class="form-group col-md-6 col-sm-6">
          <label >ขอเบิกน้ำมันครั้งล่าสุด</label>
          <input name='dayneed'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
          </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md col-sm">
          <a class="btn btn-danger  btn-block" href='basket.php'>ย้อนกลับ</a>
          </div>
          <div class="form-group col-md col-sm">
          <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
          </div>
        </FORM>
      </div>
</div>
</div>
   <?php
  mysql_close($Conn);
  ?>

  <div class="text-center" style="margin-bottom:0">
    <p>:: สำนักงานเทศบาลตำบลอุโมงค์ 2019 ::</p>
  </div>
</body>
</html>
