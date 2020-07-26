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
<body> 
<?php 
include "../config/navmenu.php";
?>


<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
    <h1>เพิ่ม บัญชี/โครงการ</h1>


	<FORM method='post'class="form-inline" ACTION="..\order\categoryinput.php" >
  <table class="table table-bordered small table-sm ">
    <thead>
      <tr>
        <th width='60%'>ชื่อ บัญชี/โครงการ</th>
        <th width='40%'>แผนงาน</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ชื่อ บัญชี/โครงการ" 
          name="add_category">
        </td>
        <td>      
              <select class="form-control  mb-2 mr-sm-2"  name="planid"  style="width:100%;" >
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
          
        </td>
      </tr>
    </tbody>
  </table>      
     <div class="form-row col-md-12">
              <div class="form-group col-md-6">
              <a class="btn btn-danger  btn-block" href='../main.php'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
              </div>
          </FORM>
            </div>





    <?php
    include "../config/connect.php";
    $sql = "select * from tb_category where catestatus='0';"; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
    <table class="table table-hover  small table-sm " ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='30%'><b>บัญชี/โครงการ</b></th>
          <th width='20%'><b>แผนงาน</b></th>
          <th width='30%'><b>หน่วยรับผิดชอบ</b></th>
          <th width='15%'><b>แก้ไข</b></th>
        </tr>

    <?php
    while ($row = mysql_fetch_array($result)) {
      $categoryID = $row["categoryID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $categoryName = $row["categoryName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $planID = $row["planID"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

      ?>
    <tr>
      <td><?php 
          $num = $num + 1;
          echo $num;
          ?></td>
      <td><?= $categoryName ?></td>
      <td>
      <?php
      $sql9 = "select * from tb_plan where planid='$planID' ;"; // ดึงข้อมูลจากตาราง product
      $result9 = mysql_db_query($dbname, $sql9);

      while ($row9 = mysql_fetch_array($result9)) {
        $planname = $row9["planname"];
        $planid = $row9["planid"];
        $deparmentID = $row9["deparmentID"];

      }
      if($planID==0){
        echo '';
      }else{
        echo $planname;
      }
      ?>
      </td>
      <td>
      
      <?php 

          $sql4 = "select * from tb_department where departmentID=$deparmentID and statusDepa='3' order by departmentID;"; // ดึงข้อมูลจากตาราง product
          $result4 = mysql_db_query($dbname, $sql4);
          while ($row4 = mysql_fetch_array($result4)) {
            $departmentName = $row4["departmentName"];
            $rootDepaID = $row4['rootDepaID'];

            $sql5 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
            $result5 = mysql_db_query($dbname, $sql5);

            while ($row5 = mysql_fetch_array($result5)) {
              $rootDepaName = $row5["departmentName"];
              $subDepaID = $row5['rootDepaID'];

              $sql6 = "select * from tb_department where departmentID='$subDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
              $result6 = mysql_db_query($dbname, $sql6);

              while ($row6 = mysql_fetch_array($result6)) {
                $subDepaName = $row6["departmentName"];
              }
              if($planID==0){
                echo '';
              }else{
                echo "งาน" . $departmentName . " [ ฝ่าย" . $rootDepaName . " - " . $subDepaName . " ]";
              }
            }
          }
          ?>
      
      </td>

      <td><a href='categoryedit.php?id_cate=<?= $categoryID ?>'>แก้ไข </a>|<a href='categorydel.php?id_del=<?= $categoryID ?>'> ยกเลิก</a></center></td>
      
    </tr>

      <?
    } ?>
        </table>
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
