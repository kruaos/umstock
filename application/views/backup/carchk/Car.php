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
<h3>สถานะการบันทึกบัญชี</h3>
    <?php 
 $perpage = 50;
 $sql5 = "select * from cr_car where statusCar='1'  order by createdate DESC";
 $query5 = mysql_db_query($dbname, $sql5);
 $total_record = mysql_num_rows($query5);
 $total_page = ceil($total_record / $perpage);
?>
            <a class="btn  btn-secondary btn-sm" href="car.php?page=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            </a>
          <?php for($i=1;$i<=$total_page;$i++){ ?>
            <a class="btn  btn-secondary btn-sm" href="car.php?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          <?php } ?>
          <a  class="btn  btn-secondary btn-sm" href="car.php?page=<?php echo $total_page;?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>

    <table  class="table table-hover   table-sm  "><tr class='text-center'>
    <th >ยี่ห้อรถยนต์</th>
    <th >แบบของรถรุ่น</th>
    <th >แรงม้า</th>
    <th >จำนวนลูกสูบ</th>
    <th >ผู้รับผิดชอบรักษารถยนต์</th>
    <th >วันที่ได้รับกรรมสิทธิ์</th>
    <th >วันที่หมดกรรมสิทธิ์</th>
    <th >กำหนดเป็น น้ำมัน 1ลิตร/กม.</th>
    <th >หมายเหตุ</th>
    
        </tr>
        <?php
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }        
    $startpage = ($page - 1) * $perpage;

        $result = mysql_db_query($dbname, $sql5);
        while ($row1 = mysql_fetch_array($result)) {
      ?>
    <tr>
      <td><?php echo $row1["CarNumber"]; ?></td>
      <td><?php echo $row1["carBrand"]; ?></td>
      <td><?php echo $row1["Hpower"]; ?></td>
      <td><?php echo $row1["piston"]; ?></td>
      <td><?php 
              $cusid=$row1["CarCusID"];
              $sql3 = "select * from tb_customer where cusid=$cusid"; 
              $result3 = mysql_db_query($dbname, $sql3);
              while ($row3 = mysql_fetch_array($result3)) {
                 echo $row3["fullname"];
              }
 ?></td>
      <td class='text-center'><?php 
                              $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
                              $showdate = number_format(substr($row1["carCreateDate"], 8, 2)) . " " . $showmont[number_format(substr($row1["carCreateDate"], 5, 2)) - 1] . " " . (substr($row1["carCreateDate"], 2, 2) + 43);
                              echo $showdate;
                              ?></td>
      <td><?php echo $row1["carEndDate"]; ?></td>
      <td><?php echo $row1["midePerKM"]; ?></td>
      <td>
        <a class="btn btn-primary btn-sm" href='carEdit.php?carID=<?php echo $row1["carID"]; ?>'><div class='small'>แก้ไข</div></a>
        <a class="btn btn-danger btn-sm" href='carDel.php?carID=<?php echo $row1["carID"]; ?>'><div class='small'>ลบ</div></a>
      </td>


    </tr>  
      <?
    } ?>
        </table>
            <a class="btn  btn-secondary btn-sm" href="car.php?page=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            </a>
          <?php for($i=1;$i<=$total_page;$i++){ ?>
            <a class="btn  btn-secondary btn-sm" href="car.php?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          <?php } ?>
          <a  class="btn  btn-secondary btn-sm" href="car.php?page=<?php echo $total_page;?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>
        <?
        mysql_close($Conn);

        ?>

  <div class="text-center" style="margin-bottom:0">
    <p>:: สำนักงานเทศบาลตำบลอุโมงค์ 2019 ::</p>
  </div>
</body>
</html>
