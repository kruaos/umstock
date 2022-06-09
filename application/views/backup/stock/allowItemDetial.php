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
  <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link href="../config/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="../config/dist/js/bootstrap-datepicker-custom.js"></script>
<script src="../config/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
<style type="text/css">   
  
#printable { display: block; }  
  
@media print   
{   
     #non-printable { display: none; }   
     #printable { display: block; }   
}   
  
</style>   

</head>
<body > 
<?php 
include "../config/navmenu.php";
include "../config/connect.php";
$sql2 = "select * from tb_customer where cusid=$sess_memberid"; 
$result2 = mysql_db_query($dbname, $sql2);
while ($row2 = mysql_fetch_array($result2)) {
  $fullname = $row2["fullname"]; 

}

function dott($n) {
  for ($i = 1; $i <= $n; $i++) {
     echo " . ";
  }
}

$orderNum=$_GET['ordernum'];
?>
<div class="container col-10 "  style="font-family: 'Sarabun', sans-serif; font-Size:14pt">
<div class="row" style="margin-top:30px">
  <div class="col-12 "style="line-height: 24pt ">
<div class="text-center"><h3>ใบเบิกพัสดุ</h3></div>
ลำดับที่ <?=$orderNum;?><br>
<div class="text-right">ฝ่าย .............................. กอง .............................. </div>
<table   width='100%'>
      <tr >
        <td  width='60%'></td>
        <td >วันที่ <?php
        $showmont = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤษจิกายน', 'ธันวาคม');
        $showdate = date('d') . " " . $showmont[date('m') - 1] . " " . (date('Y') + 543);
        echo $showdate;    
        ?></td>
      </tr>
      </table>

เรียน หัวหน้าพัสดุฯ<br>
<table   width='100%'>
      <tr >
        <td >&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ด้วยฝ่าย  กอง มีความประสงค์ต้องใช้พัสดุเพื่อ
        <?php echo dott(60);?> ดังมีรายละเอียดดังต่อไปนี้ <br>
</td>
      </tr>
      </table>
  </div>
  <div class="col-12 " >
      <table class='table table-sm border border-dark'  >
        <tr class='text-center border border-dark'>
            <th width='50' class='border border-dark'><b>ลำดับที่</b></th>
            <th width='400'class='border border-dark'><b>รายการ(บอกคุณลักษณะหรือยี่ห้อโดยรายละเอียด) </b></th>
            <th width='70'class='border border-dark'>จำนวน </th>
            <th width='100'class='border border-dark'>คงเหลือหลังเบิก</th>
            <th width='100'class='border border-dark'>หมายเหตุ</th>
        </tr>
<?php
    $sql1 = "SELECT * FROM tb_orderdetail where orderID=$orderNum"; 
      $result1 = mysql_db_query($dbname, $sql1);
      $nb = mysql_num_rows($result1);
      while ($row1 = mysql_fetch_array($result1)) {
        $productID = $row1["productID"];
        $amount = $row1["amount"];
        $productID1 = $row1["productID"];
        $productID1 = $row1["productID"];
          $sql3 = "select * from tb_product where id=$productID;"; 
          $result3 = mysql_db_query($dbname, $sql3);
          while ($row3 = mysql_fetch_array($result3)) {
            $price = $row3["price"];
            $detailBasket = $row3["productName"]." [ ".$price." บาท "."]" ;
          }
  $sumamout = $row1["quantity"];
  ?>
      <tr >
        <td class='text-center border border-dark' ><?php echo $startout = $startout + 1; ?></td>
        <td class='text-left border border-dark'><?php echo $detailBasket; ?></td>
        <td class='text-center border border-dark'><?php echo $amount; ?> </td>
        <td class='text-right border border-dark'><?php ?></td>
        <td class='text-right border border-dark'><?php ?></td>
       </tr>
        <?php
      } 
      $y=15-$nb;
      for($x=1;$x<=$y;$x++){
        ?>
      <tr >
        <td class='text-center border border-dark'>&nbsp;</td>
        <td class='text-left border border-dark'></td>
        <td class='text-right border border-dark'> </td>
        <td class='text-right border border-dark'></td>
        <td class='text-right border border-dark'></td>
       </tr>
        <?php
      }
      ?>
  <tr >
        <td class='text-center' ></td>
        <td class='text-center'>รวมเบิก</td>
        <td class='text-right  border border-dark'> </td>
        <td class='text-right  border border-dark'></td>
        <td class='text-right border border-dark'></td>
       </tr>
      </table>
      <div style="line-height: 24pt ">

พัสดุดังกล่าวต้องการภายในกำหนด <?php echo dott(30);?> วัน <br>
ขอได้โปรดจ่ายพัสดุดังกล่าวให้ภายกำหนดด้วย <br>
&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo dott(30);?>เจ้าหน้าที่กอง<?php echo dott(30);?><br>
&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php echo dott(30);?>หัวหน้าน่วยงาน<?php echo dott(30);?><br>
ความเห็นของเจ้าหน้าที่พัสดุ <?php echo dott(150);?><br>
<table   width='100%'>
      <tr >
        <td  width='40%'></td>
        <td ><?php echo dott(20);?>เจ้าหน้าที่พัสดุ<br>(<?php echo dott(20);?>)  </td> 
      </tr>
      </table>

[ &nbsp;&nbsp; ] &nbsp;&nbsp;จ่ายพัสดุให้ตามที่ขอ <br>
[ &nbsp;&nbsp; ] &nbsp;&nbsp;ทำรายการเสนอสั่งซื้อ<br>
<table   width='100%'>
      <tr >
        <td  width='40%'></td>
        <td ><?php echo dott(20);?> ผู้อำนวยการกอง<br>(<?php echo dott(20);?>)  </td> 
      </tr>
      </table>

ได้รับพัสดุตามที่ขอเบิกถูกต้องแล้ว<br>

<table   width='100%'>
      <tr >
        <td  width='40%'></td>
        <td ><?php echo dott(20);?>ผู้ขอเบิก<br>
(<?=$fullname;?>)<br>
.........../.........../...........<br></td> 
      </tr>
      </table>
</div>
      <div class="row">
      <a id="non-printable" class="btn btn-danger btn-sm col " href='allowItem.php'>ย้อนกลับ</a>
      <a id="non-printable" class="btn btn-info  btn-sm col" href='#'>อนุมัติ</a>

      </div>
    </div>
  </div>
   <?php
  mysql_close($Conn);
  ?>
    </div> 
  </div>
</div>

<div class=" text-center" style="background-color:Orange; margin-bottom:0; margin-top:30px">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
