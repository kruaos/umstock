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
<body> <?php 
  include "../config/navmenu.php";
?>


<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
    <h1>ตั้งค่าแฟ้มใหม่ </h1>


	<FORM method='post'class="form-inline" ACTION="../order/planupdate.php" >
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width='60%'>แผนงาน</th>
        <th width='20%'>หน่วยรับผิดชอบ</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php 
        $planid=$_GET['planid'];
        include "../config/connect.php";
        $sql = "select * from tb_plan where planid='$planid';"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname,$sql);
        while($row = mysql_fetch_array($result)){
?>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  value='<?php echo $row["planname"];?>'
          name="add_planname">
        </td>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  value='<?php echo $row["deparmentID"];?>'
          name="add_department">
          <input type="hidden" name='planid' value='<?php echo $row['planid'];?>'>
        </td>
      </tr>
    </tbody>
        <?php } ?>    
  </table>      
        <button type="submit" class="btn btn-warning  btn-block">บันทึกข้อมูล</button>
</FORM>
<a class="btn btn-danger  btn-block" href='plan.php'>ย้อนกลับ</a>




    
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
