<!DOCTYPE html>
<html lang="en">
<head>

  <TITLE>Member ระบบสมาชิก</TITLE></HEAD>
<BODY>
    <title>UMStock</title>
      <meta http-equiv=Content-Type content="text/html; charset=utf-8">
      
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
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
    
    
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
     <h3 class="text-muted"><a href ='../index.php'>UMStock</a></h3>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
    
<div class="container">

    <div style="margin-bottom:0">
<H1>:: Register ::</H1>
<FORM METHOD="POST" ACTION="registeradd.php">
<TABLE CELLSPACING="2">
    <TR> 
      <TD><B>ชื่อเข้าใช้ :</B> </TD>
	  <TD><INPUT NAME="user_reg" TYPE="text"> * </TD>
    </TR>
    <TR> 
      <TD><B>รหัสผ่าน : </B></TD>
      <TD><INPUT NAME="pass_reg" TYPE="password"> * </TD>
    </TR>
</table>   
ข้อมูลส่วนตัว
          <hr> 
<table>
    <TR> 
      <TD><B>ชื่อ - สกุล :</B> </TD>
      <TD>           
        <select class="form-control" name='name_reg'>
      <?php
      include "../config/connect.php";
      $sql = "select * from tb_customer where status='1' order by cusid;"; // ดึงข้อมูลจากตาราง product
      $result = mysql_db_query($dbname, $sql);

      while ($row = mysql_fetch_array($result)) {
        $customerName = $row["fullname"];
        $cusid = $row["cusid"];
        echo "<option value='" . $cusid . "'> [" . $cusid . '] ' . $customerName . "</option>";
      }
      ?>
      </select>
      </TD>
    </TR>
    <TR> 
      <TD><B>กอง : </B></TD>
      <TD>
      <select class="form-control"  name='department'>
        <?php
        $sql1 = "select * from tb_department where statusDepa='1' order by departmentID;"; // ดึงข้อมูลจากตาราง product
        $result1 = mysql_db_query($dbname, $sql1);

        while ($row1 = mysql_fetch_array($result1)) {
            $departmentID = $row1["departmentID"];
            $departmentName = $row1["departmentName"];
            echo "<option value='" . $departmentID . "' >" . $departmentName . "</option>";
        }
        ?>
        </select>
</TD>

    </TR>
    <TR> 
      <TD><B>ฝ่าย : </B></TD>
      <TD><INPUT NAME="division" TYPE="text" SIZE="26"> * </TD>
    </TR>
    <TR> 
      <TD>&nbsp;</TD>
      <TD><INPUT class="btn  btn-success  btn-sm"  TYPE="Submit" value="ลงทะเบียน"> 
      <INPUT class="btn btn-danger  btn-sm"  TYPE="Reset" value="ยกเลิก">
      <a class="btn btn-info  btn-sm"  href='../index.php'>ย้อนกลับ</a>
      </TD>
    </TR>
</TABLE>
</FORM>
</div>
</div>

</BODY>
</HTML>