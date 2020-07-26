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
    <h1>เพิ่มกอง ฝ่าย งาน  </h1>
    <form method="POST" action="departmenttadd.php">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">สำนัก/กอง</label>
        <div class="col-sm-8">
        <input type="text" name="DepatName" class="form-control" placeholder="สำนัก/กอง">
        <input type="hidden" name="statusDepa" class="form-control"  value='1'>
        <input type="hidden" name="rootDepaID" class="form-control"  value='0'>

        </div>
            <div class="col-sm-2">
        <button type="submit" class="btn btn-primary">บันทึก สำนัก/กอง</button>
        </div>
    </div>
    </form>
<?php /*
    สถานะของกองฝ่าย statusDepa
    1 สำนัก / กอง 
    2 ฝ่าย 
    3 งาน/ โครงการ 
    0 ยกเลิก
 */ ?>

    <form method="POST" action="departmenttadd.php">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">ฝ่าย</label>
        <div class="col-sm-4">
        <select class="form-control"  name='rootDepaID'>
        <?php
        include "../config/connect.php";
        $sql1 = "select * from tb_department where statusDepa='1' order by departmentID;"; // ดึงข้อมูลจากตาราง product
        $result1 = mysql_db_query($dbname, $sql1);

        while ($row1 = mysql_fetch_array($result1)) {
            $departmentID = $row1["departmentID"];
            $departmentName = $row1["departmentName"];
            echo "<option value='" . $departmentID . "' >" . $departmentName . "</option>";
        }
        ?>
        </select>
        </div>
        <div class="col-sm-4">
        <input type="text" name="DepatName" class="form-control"  placeholder="ฝ่าย">
        <input type="hidden" name="statusDepa" class="form-control"  value='2'>

        </div>
            <div class="col-sm-2">
        <button type="submit" class="btn btn-success">บันทึก ฝ่าย</button>
        </div>
    </div>
    </form>
    <form method="POST" action="departmenttadd.php">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">งาน</label>
        <div class="col-sm-4">
        <select class="form-control"  name='rootDepaID'>
        <?php
        $sql2 = "select * from tb_department where statusDepa='2' order by departmentID;"; // ดึงข้อมูลจากตาราง product
        $result2 = mysql_db_query($dbname, $sql2);

        while ($row2 = mysql_fetch_array($result2)) {
            $departmentID = $row2["departmentID"];
            $departmentName = $row2["departmentName"];
            $rootDepaID = $row2['rootDepaID'];

            $sql3 = "select * from tb_department where departmentID='$rootDepaID' and statusDepa=1 order by departmentID;"; // ดึงข้อมูลจากตาราง product
            $result3 = mysql_db_query($dbname, $sql3);

            while ($row3 = mysql_fetch_array($result3)) {
                $rootDepaName = $row3["departmentName"];


                echo "<option value='" . $departmentID . "' >" . $rootDepaName . " [ " . $departmentName . " ]" . "</option>";
            }
        }
        ?>
        </select>        </div>
        <div class="col-sm-4">
        <input type="text" name="DepatName" class="form-control" placeholder="งาน">
        <input type="hidden" name="statusDepa" class="form-control"  value='3'>

        </div>
            <div class="col-sm-2">
        <button type="submit" class="btn btn-warning">บันทึก งาน</button>
        </div>
    </div>
    </form>

	
<a class="btn btn-danger  btn-block" href='#'>ย้อนกลับ</a>
    <table class="table table-hover" ><tr  class="table-active">
    <?php
    $sql = "select * from tb_department where statusDepa=1 order by departmentID;"; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
          <th width='10%'><b>ลำดับ</b></th>
          <th width='70%'><b>กอง / สำนัก</b></th>
          <th width='20%'><b>แก้ไข</b></th>
        </tr>

    <?php
    while ($row = mysql_fetch_array($result)) {
        $departmentID = $row["departmentID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $departmentName = $row["departmentName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
        $rootDepaID = $row["rootDepaID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $statusDepa = $row["statusDepa"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

        ?>
    <tr>
      <td><?php 
            $num2 = $num2 + 1;
            echo $num2;
            ?></td>
      <td><?php 

            echo $departmentName; ?></td>
      <td><a href='departmenttedit.php?depaID=<?= $departmentID ?>'>แก้ไข </a>|<a href='departmenttdel.php?depaID=<?= $departmentID ?>'> ยกเลิก</a></center></td>
    </tr>

      <?
    } ?>
        <table>
        <table class="table table-hover" ><tr  class="table-active">
    <?php
    $sql = "select * from tb_department where statusDepa=2 order by departmentID;"; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
          <th width='10%'><b>ลำดับ</b></th>
          <th width='40%'><b>ฝ่าย</b></th>
          <th width='30%'><b>กอง / สำนัก</b></th>
          <th width='20%'><b>แก้ไข</b></th>
        </tr>

    <?php
    while ($row = mysql_fetch_array($result)) {
        $departmentID = $row["departmentID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $departmentName = $row["departmentName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
        $rootDepaID = $row["rootDepaID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $statusDepa = $row["statusDepa"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

        ?>
    <tr>
      <td><?php 
            $num3 = $num3 + 1;
            echo $num3;
            ?></td>
      <td><?php echo $departmentName ?></td>
      <td><?php 
            $sql4 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
            $result4 = mysql_db_query($dbname, $sql4);

            while ($row4 = mysql_fetch_array($result4)) {
                $rootDepaName = $row4["departmentName"];
            }
            echo $rootDepaName; ?></td>
      <td><a href='departmentedit.php?depaID=<?= $departmentID ?>'>แก้ไข </a>|<a href='departmenttdel.php?depaID=<?= $departmentID ?>'> ยกเลิก</a></center></td>
    </tr>

      <?
    } ?>
        <table>
        <table class="table table-hover" ><tr  class="table-active">
    <?php
    $sql = "select * from tb_department where statusDepa=3 order by departmentID;"; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
          <th width='10%'><b>ลำดับ</b></th>
          <th width='40%'><b>งาน</b></th>
          <th width='30%'><b>กอง/ สำนัก [ฝ่าย ]</b></th>
          <th width='20%'><b>แก้ไข</b></th>
        </tr>

    <?php
    while ($row = mysql_fetch_array($result)) {
        $departmentID = $row["departmentID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $departmentName = $row["departmentName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
        $rootDepaID = $row["rootDepaID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $statusDepa = $row["statusDepa"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

        ?>
    <tr>
      <td><?php 
            $num = $num + 1;
            echo $num;
            ?></td>
      <td><?= $departmentName ?></td>
      <td><?php 
            $sql5 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
            $result5 = mysql_db_query($dbname, $sql5);

            while ($row5 = mysql_fetch_array($result5)) {
                $rootDepaName = $row5["departmentName"];
                $rootDepaID = $row5["rootDepaID"];
                $sql6 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
                $result6 = mysql_db_query($dbname, $sql6);

                while ($row6 = mysql_fetch_array($result6)) {
                    $subDepaName = $row6["departmentName"];
                }
            }
            echo $subDepaName." [".$rootDepaName."] "; ?></td>
      <td><a href='departmentedit.php?depaID=<?= $departmentID ?>'>แก้ไข </a>|<a href='departmenttdel.php?depaID=<?= $departmentID ?>'> ยกเลิก</a></center></td>
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
