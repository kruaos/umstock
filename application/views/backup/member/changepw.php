<?
include "../config/chksession.php";
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
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  </style>
</head>
<body><?php 
  include "../config/navmenu.php";
?>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-8">
<h1>:: Change Password ::</h1>
<FORM METHOD=POST ACTION="changepw2.php">
  <TABLE cellspacing="2">
    <TR>       <TD><B>Username : </B></TD> <TD><?=$sess_username?></TD>   </TR>
    <TR>       <TD><B>รหัสผ่านเดิม : </B></TD><TD><INPUT name="oldpass" type="password"> * </TD>
    </TR>
    <TR>       <TD><B> รหัสผ่านใหม่: </B></TD><TD><INPUT name="newpass" type="password"> * </TD>
    </TR>
    <TR>       <TD><B>ยืนยันรหัสผ่านใหม่ :</B></TD><TD><INPUT name="newpass2" type="password"> * </TD>
    </TR>
    <TR> 
      <TD>&nbsp;</TD>
      <TD><INPUT TYPE="Submit" VALUE="Submit"> <INPUT TYPE="Reset" VALUE="Reset"></TD>
    </TR>
  </TABLE>
</FORM>
[ <a href="main.php">กลับหน้าหลัก</a> ] 

</div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>:: สำนักงานเทศบาลตำบลอุโมงค์ 2019 ::</p>
</div>

</body>
</html>
