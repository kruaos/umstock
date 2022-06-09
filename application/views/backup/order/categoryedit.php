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
    <h1>แก้ไข บัญชี /โครงการ </h1>


	<FORM method='post'class="form-inline" ACTION="../order/categoryupdate.php" >
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width='60%'>ชื่อแฟ้ม</th>
        <th width='40%'>แผนงาน</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php 
        $idcate=$_GET['id_cate'];
        include "../config/connect.php";
        $sql = "select * from tb_category where categoryID='$idcate';"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname,$sql);
        while($row = mysql_fetch_array($result)){
?>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  value='<?php echo $row["categoryName"];?>'
          name="add_category">
        </td>
        <td>

        <select class="form-control  mb-2 mr-sm-2"  name="add_department"  style="width:100%;" >
              <?php
              include "../config/connect.php";

              $sql2 = "select * from tb_plan where planstatus='0' order by planname;"; // ดึงข้อมูลจากตาราง product
              $result2 = mysql_db_query($dbname, $sql2);

              while ($row2 = mysql_fetch_array($result2)) {
                $planname = $row2["planname"];
                $planid = $row2["planid"];
                echo "<option value='" . $planid . "' >" . $planname . "</option>";
              }
              ?>
              </select> 
          <input type="hidden" name='id_cate' value='<?php echo $row['categoryID'];?>'>
        </td>
      </tr>
    </tbody>
        <?php } ?>    
  </table>      
  
  <div class="form-row col-md-12">
              <div class="form-group col-md-6">
<a class="btn btn-danger  btn-block" href='categoryadd.php'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
        <button type="submit" class="btn btn-warning  btn-block">บันทึกข้อมูล</button>
              </div>
          </FORM>
            </div>




    
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
