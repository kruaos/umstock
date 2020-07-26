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
  
    <?php
    include "../config/connect.php";
    $sql = "select * from tb_category where catestatus='0';"; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
    <table class="table table-hover  small table-sm " ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='20%'><b>บัญชี/โครงการ</b></th>
          <th width='20%'><b>แผนงาน</b></th>
          <th width='20%'><b>หน่วยรับผิดชอบ</b></th>
          <th width='10%'><b>จำนวนพัสดุ</b></th>
          <th width='10%'><b>รับ</b></th>
          <th width='10%'><b>จ่าย</b></th>
          <th width='10%'><b>คงเหลือ</b></th>

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
      <td>
      
      <?php 
        echo "<a href='ReportProduct.php?categoryID=".$categoryID."'>".$categoryName."</a>";
      ?>
      
      </td>
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
                echo  $departmentName . " [ ฝ่าย" . $rootDepaName . " - " . $subDepaName . " ]";
              }
            }
          }
          ?>
      
      </td>
          <td>
          <?php 
          $sql7 = "select * from tb_product where statusproduct='0' and categoryID=$categoryID order by productname ;"; 
          $result7 = mysql_db_query($dbname, $sql7);
          $Num_Rows = mysql_num_rows($result7);
          echo $Num_Rows." รายการ" ;
          ?>
       </td>
          <td >
          <?php 
          $sql8 = "select SUM(a.amount*b.price)as'sumin' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and a.statusOrder<>'ou' and a.categoryID=$categoryID and a.statusfile=0";
          $result8 = mysql_db_query($dbname, $sql8);
          $row8 = mysql_fetch_array($result8);
          echo $sumin=number_format($row8['sumin']);
          ?>          
          </td>
          <td >
          <?php 
          $sql9 = "select SUM(a.amount*b.price)as'sumout' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and a.statusOrder='ou' and a.categoryID=$categoryID and a.statusfile=0"; 
          $result9 = mysql_db_query($dbname, $sql9);
          $row9 = mysql_fetch_array($result9);
          echo  $sumout = number_format(abs($row9['sumout']));
          ?>          
          </td>
          <td >
          <?php 
          echo   number_format($row8['sumin']-abs($row9['sumout']));
          ?>          
          </td>
      
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
