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


</head>
<body> 
<?php 
include "../config/navmenu.php";
include "../config/connect.php";
$memberid=$_GET['memberid'];
$sql = "select * from tb_customer where cusid=$memberid "; // ดึงข้อมูลจากตาราง product
$result = mysql_db_query($dbname, $sql);
while ($row = mysql_fetch_array($result)) {
    $fullname=$row['fullname'];
    $department=$row['department'];
    $diveision=$row['diveision'];
}




?>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-xs-1"></div>
    <div class="col-sm-12 col-md-12 col-xs-12">
    <h1>เพิ่มข้อมูลสมาชิก</h1>

<form method='post' action="memberUpdate.php">

  <div class="form-row">
    <div class="form-group col-md-4 ">
        <label >ชื่อ-สกุล</label>
        <input type="hidden" name='cusid' value='<?=$memberid;?>'>
        <input type="text" class="form-control" name='fullname' class="form-control" id="text" value="<?=$fullname;?>">
    </div>    
    <div class="form-group col-md-4 ">
        <label >ตำแหน่ง</label>
        <input type="text" class="form-control" name='diveision' class="form-control" id="text" value="<?=$diveision;?>" >
   </div>   
    <div class="form-group col-md-4 ">
        <label >สังกัด</label>
        <select class="form-control"  name='departmentID'>
        <?php
        $sql2 = "select * from tb_department where statusDepa<>0 and rootDepaID=0  order by departmentName;"; // ดึงข้อมูลจากตาราง product
        $result2 = mysql_db_query($dbname, $sql2);

        while ($row2 = mysql_fetch_array($result2)) {
            $departmentID = $row2["departmentID"];
            $departmentName = $row2["departmentName"];
            $rootDepaID = $row2['rootDepaID'];
            if ($department==$departmentID){$chkk='selected';}else{$chkk=' ';}
                echo "<option value='" . $departmentID . "'". $chkk." >"  . $departmentName ."</option>";
                }
        ?>
        </select>  </div>
  </div>
  <div class="form-row ">
    <a href="member.php" class="btn btn-danger col">ยกเลิก</a>
    <button type="submit" class="btn btn-warning col">บันทึกรายการ</button>
  </div>
</form>


 
        <?
        mysql_close($Conn);
      
        ?>
    </div>
    <div class="col-xs-1"></div>
  </div>
</div>
<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
