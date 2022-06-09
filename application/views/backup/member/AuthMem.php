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
?>
<div class="container col-10 " >
  <div class="row" style="margin-top:30px">
    <div class="col-12 ">
    <h3>กำหนดสิทธิผู้ใช้บริการ<h3>
    </div>
  <div class="col ">
  <table class="table  table-hover small table-sm">
    <thead>
      <tr>
        <th width='5%'>ลำดับที่</th>
        <th width='20%'>ชื่อผู้ใช้</th>
        <th width='10%'>วันที่เบิก</th>
        <th width='10%'>วันที่ต้องการ</th>
        <th width='40%'>สถานะ</th>
      </tr>
    </thead>
    <tbody>
<?php 
$num=1;
$sql = "select * from tb_member where authority<>'a' and memberID<>1 "; 
$result = mysql_db_query($dbname, $sql);
while ($row = mysql_fetch_array($result)) {
  $memberID = $row["memberID"]; 
  $createdate = $row["reg_date"]; 
  $cusid = $row["name"]; 
  $authority = $row["authority"]; 

        $sql1 = "select * from tb_customer where cusid=$cusid"; 
        $result1 = mysql_db_query($dbname, $sql1);
        while ($row1 = mysql_fetch_array($result1)) {
          $fullname = $row1["fullname"];	 
        }

  $createdate = $row["reg_date"]; 
  
?>
      <tr>
      <td><?echo $num; $num=$num+1;?></td>
        <td><?=$fullname;?></td>
        <td><?php 
              $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
              $showdate = number_format(substr($row["reg_date"], 8, 2)) . " " . $showmont[number_format(substr($row["reg_date"], 5, 2)) - 1] . " " . (substr($row["reg_date"], 2, 2) + 43);
              echo $showdate;      
          ?></td>
        <td><?php 
        if($authority=='w'){
          echo "รออนุมัติ" ;
        }else if($authority=='s'){
          echo "เจ้าหน้าที่" ;
        }else if($authority=='u'){
          echo "ผู้ใช้" ;
        }else if($authority=='m'){
        echo "ผู้บริหาร" ;
        }else if($authority=='o'){
          echo "ยกเลิก" ;
          }
        ?></td>
        <td>
        <a class="btn btn-warning  col-2  btn-sm" href='AuthMemEdit.php?setid=m&memberID=<?=$memberID;?>'><div class='small'>ผู้บริหาร</div></a>
        <a class="btn btn-success col-2  btn-sm" href='AuthMemEdit.php?setid=s&memberID=<?=$memberID;?>'><div class='small'>เจ้าหน้าที่</div></a>
        <a class="btn btn-info col-2  btn-sm" href='AuthMemEdit.php?setid=u&memberID=<?=$memberID;?>'><div class='small'>ผู้ใช้</div></a>
        <a class="btn btn-danger col-2  btn-sm" href='AuthMemEdit.php?setid=o&memberID=<?=$memberID;?>'><div class='small'>ยกเลิก</div></a>
        </td>
      </tr>
<?php 
}
mysql_close($Conn);
?>
    </tbody>
  </table>
  </div>
  </div>
 </div>

 <div class=" text-center" style="background-color:Orange; margin-bottom:0; margin-top:30px">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
