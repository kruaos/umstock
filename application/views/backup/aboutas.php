<?
include "member/chksession.php";

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
    .navbar {margin-bottom: 0; border-radius: 0;    }
    footer {background-color: #f2f2f2; padding: 25px;  }
  </style>
</head>
<body>
<?php 
$chkmain = 1;
include "config/navmenu.php";
if($chkmain==null){
  $jumpto="../";
}else{
  $jumpto="";
}

?>

<div class="container" style="margin-top:30px">
  <h2>บันทึกการพัฒนา</h2>
  <p>ระบบบริหารพัสดุสำนักงาน เทศบาลตำบลอุโมงค์</p>            

  <iframe height="500" 
   scrolling="no" frameborder="0" style = "border:0px;overflow:hidden;"
   class="col-12" src="https://docs.google.com/document/d/e/2PACX-1vSM2D0ccvk1nxXqtAOax-sAAqzc_SyTz-yYRuH8uawjkF7UeQmfzcokVtlybMDwSEXH3cywYo5973L5/pub?embedded=true"></iframe>
  
</div>

</body>
</html>
