<?
include "../config/chksession.php";
include "function.php";
include "../config/connect.php";
$sql="select * from tb_member where username='$sess_username' ";
$result=mysql_db_query($dbname,$sql);
$record=mysql_fetch_array($result);

$username=$record['username'];
$name=$record['name'];
$sex=$record['sex'];
$department=$record['department'];
$division=$record['division'];
$reg_date=$record['reg_date'];

mysql_close();
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
    <h1>:: Edit Member ::</h1>
<FORM METHOD="POST" ACTION="edit2.php">
  <TABLE CELLSPACING="2">
    <TR> 
      <TD><B>Username : </B></TD><TD><?=$username?></TD>
    </TR>
    <TR> 
      <TD><B>ชื่อ - สกุล : </B></TD><TD><?=$name?></TD>
    </TR>

    <TR> 
      <TD><B>กอง : </B></TD>
      <TD><INPUT NAME="department" TYPE="text" VALUE="<?=$department?>" SIZE="26">  </TD>
    </TR>
    <TR> 
      <TD><B>ฝ่าย : </B></TD>
      <TD><INPUT NAME="division" TYPE="text" VALUE="<?=$division?>" SIZE="26"></TD>
    </TR>
    <TR>
      <TD><B>สมัครเมื่อ :</B></TD>
      <TD><?php 
      date_default_timezone_set("Asia/Bangkok");
      echo displaydate($reg_date);?>
      </TD>
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



