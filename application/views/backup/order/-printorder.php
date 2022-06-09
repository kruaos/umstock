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
$sql2 = "select * from tb_customer where cusid=$sess_memberid"; 
$result2 = mysql_db_query($dbname, $sql2);
while ($row2 = mysql_fetch_array($result2)) {
  $fullname = $row2["fullname"]; 

}
?>
<div class="container col-10 " >
  <div class="row" style="margin-top:30px">
    <div class="col-12 ">
    ข้อมูลส่วนตัว ของ<?=$fullname;?>
    </div>
  <div class="col ">
  <table class="table  table-hover small table-sm">
    <thead>
      <tr>
        <th width='100'>ลำดับที่</th>
        <th width='100'>ใบเบิกที่</th>
        <th width='300'>ชื่อผู้เบิก</th>
        <th width='150'>วันที่เบิก</th>
        <th width='150'>วันที่ต้องการ</th>
        <th width='200'>สถานะ</th>
        <th class='text-center'>หมายเหตุ</th>
      </tr>
    </thead>
    <tbody>
<?php 
$num=1;
$sql = "select * from tb_order where memberID=$sess_memberid and status=1 "; 
$result = mysql_db_query($dbname, $sql);
while ($row = mysql_fetch_array($result)) {
  $memberID = $row["memberID"]; 
  $orderNum = $row["orderNum"]; 
  $dayneed = $row["dayneed"]; 
  $detail = $row["detail"]; 
  $staff1 = $row["staff1"]; 
  $createdate = $row["createdate"]; 
  $orderID = $row["orderID"]; 
?>
      <tr>
      <td><?echo $num; $num=$num+1;?></td>
        <td><?=$orderNum;?></td>
        <td><?=$fullname;?></td>
        <td><?php 
              $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
              $showdate = number_format(substr($row["createdate"], 8, 2)) . " " . $showmont[number_format(substr($row["createdate"], 5, 2)) - 1] . " " . (substr($row["createdate"], 2, 2) + 43);
              echo $showdate;      
          ?></td>
        <td><?php 
              $dayneed = number_format(substr($row["dayneed"], 8, 2)) . " " . $showmont[number_format(substr($row["dayneed"], 5, 2)) - 1] . " " . (substr($row["dayneed"], 2, 2) + 43);
              echo $dayneed;      
          ?></td>
        <td><?php 
        if($staff1==0){
          echo "รออนุมัติ" ;
        }else if($staff1==1){
          echo "อนุมัติแล้ว" ;
        }
        ?></td>
        <td>
        <a class="btn btn-primary btn-sm" href='printorderDetial.php?ordernum=<?=$orderNum;?>'><div class='small'>รายละเอียด</div></a>
        <a class="btn btn-danger  btn-sm" href='printorderDel.php?ordernum=<?=$orderNum;?>'><div class='small'>ยกเลิก</div></a>
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
