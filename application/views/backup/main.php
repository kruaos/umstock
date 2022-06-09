<?php
include "member/chksession.php";
include "config/connect.php";
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


  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<?php 
  $chkmain=1;
  include "config/navmenu.php";
?>
<div class=" text-center" style="margin-bottom:0 ,margin-top:0px">
<h1>ระบบบริหารพัสดุสำนักงานเทศบาลตำบลอุโมงค์</h1>
<p>ยินดีต้อนรับคุณ <b>
  
<?php
      $sql = "select * from tb_customer where cusid=$sess_memberid;"; // ดึงข้อมูลจากตาราง product
      $result = mysql_db_query($dbname, $sql);
      while ($row = mysql_fetch_array($result)) {
        $customerName = $row["fullname"];
        $cusid = $row["cusid"];
        echo $customerName;
      }
      ?>




</b> โปรดทำรายการที่ท่านต้องการ</p>
</div>



<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">


  <img src="picture\informe.png" class="mx-auto col-6 d-block">

    </div>
  </div>
</div>

<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019  Version 0.1 (Demo)</p>
</div>

</body>
</html>
