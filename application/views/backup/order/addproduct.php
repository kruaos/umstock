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
  $cateID=$_GET['categoryID'];
  if($cateID==null){
  ?>
  <?php
      include "../config/connect.php";
      $sql = "select * from tb_category where catestatus='0';"; // ดึงข้อมูลจากตาราง product
      $result = mysql_db_query($dbname, $sql);
      ?>
      <table class="table table-hover small table-sm " ><tr >
            <th width='5%'><b>ลำดับ</b></th>
            <th width='30%'><b>บัญชี/โครงการ</b></th>
            <th width='20%'><b>แผนงาน</b></th>
            <th width='30%'><b>หน่วยรับผิดชอบ</b></th>
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
        <td><a href="addproduct.php?categoryID=<?php echo $categoryID;?>"><?= $categoryName ?></a></td>
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
    </tr>
  
        <?
      } ?>
          <table>
          <?
          mysql_close($Conn);
          ?>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
  
  
  <?
  }else{
    $cateID=$_GET['categoryID'];
  ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-12">
    <h1>เพิ่มรายการพัสดุ</h1>


	<FORM method='post'class="form-inline" ACTION="..\order\addproduct2.php" >
  <table class="table table-bordered small table-sm ">
    <thead>
      <tr>
        <th width='60%'>รายการพัสดุ</th>
        <th width='20%'>ราคาพัสดุ</th>
        <th width='20%'>บัญชี/ โครงการ</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ข้อมูลพัสดุ" 
          name="add_product">
        </td>
        <td>      
          <input type="text" style="width:100%;"  class="form-control  mb-2 mr-sm-2"  placeholder="ระบุตัวเลข(บาท)" 
          name="add_price">
        </td>
        <td>      

      <select class="form-control"  style="width:100%;"  name='categoryID' >
        <?php
        include "../config/connect.php";
        if ($_GET['categoryID']==null){
          $sql4 = "select * from tb_category order by categoryName;"; // ดึงข้อมูลจากตาราง product
        }else{
          $cateID=$_GET['categoryID'];
          $sql4 = "select * from tb_category where categoryID=$cateID  order by categoryName;"; // ดึงข้อมูลจากตาราง product
        }
        $result4 = mysql_db_query($dbname, $sql4);

        while ($row4 = mysql_fetch_array($result4)) {
          $categoryID = $row4["categoryID"];
          $categoryName = $row4["categoryName"];
          echo "<option value='" .$categoryID. "'>" .$categoryName . "</option>";
        }
        ?>
        </select>
        </td>
      </tr>
    </tbody>
  </table>      
 
        <div class="form-row col-md-12">
              <div class="form-group col-md-6">
              <a class="btn btn-danger  btn-block" href='addorder.php'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary  btn-block">เพิ่มรายการพัสดุ</button>
              </div>
          </FORM>
            </div>
  <table width='100%' class="table table-hover  small table-sm "><tr class='text-center'>
          <th width='10%'><b>ลำดับ</b></th>
          <th width='20%'><b>ชื่อพัสดุ</b></th>
          <th width='20%'><b>บัญชี/ โครงการ</b></th>
          <th width='10%'><b>ราคา</b></th>
          <th width='10%'><b>จำนวน</b></th>
          <th width='20%'><b>แก้ไข</b></th>
        </tr>
   <?php
           if($_GET['categoryID']==null){
             $sql = "select * from tb_product where statusproduct='0' order by productname ;"; // ดึงข้อมูลจากตาราง product
           }else{
             $sql = "select * from tb_product where statusproduct='0'  and categoryID=$cateID  order by productname ;"; // ดึงข้อมูลจากตาราง product
           }
        
        $result = mysql_db_query($dbname,$sql);
        while($row = mysql_fetch_array($result)){ 
          $productID = $row["id"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
          $productName = $row["productName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
          $productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
          $categoryID = $row["categoryID"]; 
          $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 "; 
          $result2 = mysql_db_query($dbname,$sql2);
          while($row2 = mysql_fetch_array($result2)){ 
            $sumamo=number_format($row2["sumamo"]);
            if ($sumamo==0){
              $showdanger='alert alert-danger';
?>
                <tr class='text-center <?=$showdanger;?>'>
                  <td ><?php echo $num=$num+1;            ?></td>
                  <td class="text-left" ><?php 
                        echo "<a href='orderdetail.php?productid=" . $productID . "'>" . $productName . "</a>";
                  ?></td>
                  <td>
                  <?php 
                  $sqlcate = "select * from tb_category where categoryID='$categoryID';"; // ดึงข้อมูลจากตาราง product
                  $resultcate = mysql_db_query($dbname, $sqlcate);
                  while ($rowcate = mysql_fetch_array($resultcate)) {
                    $categoryName = $rowcate["categoryName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
                  } 
                  if($categoryID==0){
                    echo "<span class='badge badge-danger'>กำหนด บัญชี/โครงการ</span> ";
                  }else{
                    echo $categoryName;
                  }
                  ?>
                  </td>
                  <td><?=$productPrice?></td>
                  <td>   <?php
                      if ($sumamo==0){
                        echo "หมด";
                      }else if($sumamo<=2){
                        echo $sumamo." <span class='badge badge-danger'>เหลือน้อย</span> ";          
                      }else{
                        echo $sumamo;
                      }
                    ?> 
                  </td>
                  <td><a href='productedit.php?id_prod=<?=$productID?>'>แก้ไข </a>
                  |<a href='productdel.php?id_del=<?=$productID?>'> ยกเลิก</a></td>
                </tr>

<?php
            
              }else if($sumamo<=2){
                $showdanger='alert alert-warning ';
              }else{
              $showdanger='';
            }
        ?>
      <?    }
      } ?>
        </table>

          <table width='100%' class="table table-hover small table-sm "><tr class='text-center'>
                    <th width='10%'><b>ลำดับ</b></th>
                    <th width='20%'><b>ชื่อพัสดุ</b></th>
                    <th width='20%'><b>บัญชี/ โครงการ</b></th>
                    <th width='10%'><b>ราคา</b></th>
                    <th width='10%'><b>จำนวน</b></th>
                    <th width='20%'><b>แก้ไข</b></th>
                  </tr>
             <?php

                      
                  $result = mysql_db_query($dbname,$sql);
                  while($row = mysql_fetch_array($result)){ 
                    $productID = $row["id"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
                    $productName = $row["productName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
                    $productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
                    $categoryID = $row["categoryID"]; 
                    $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 "; 
                    $result2 = mysql_db_query($dbname,$sql2);
                    while($row2 = mysql_fetch_array($result2)){ 
                      $sumamo=number_format($row2["sumamo"]);
                      if ($sumamo==0){
                        $showdanger='alert alert-danger';
                      
                        }else if($sumamo<=2){
                          $showdanger='alert alert-warning ';
          ?>
                          <tr class='text-center <?=$showdanger;?>'>
                            <td ><?php echo $num=$num+1;            ?></td>
                            <td class="text-left" ><?php 
                                  echo "<a href='orderdetail.php?productid=" . $productID . "'>" . $productName . "</a>";
                            ?></td>
                            <td>
                            <?php 
                            $sqlcate = "select * from tb_category where categoryID='$categoryID';"; // ดึงข้อมูลจากตาราง product
                            $resultcate = mysql_db_query($dbname, $sqlcate);
                            while ($rowcate = mysql_fetch_array($resultcate)) {
                              $categoryName = $rowcate["categoryName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
                            } 
                            if($categoryID==0){
                              echo "<span class='badge badge-danger'>กำหนด บัญชี/โครงการ</span> ";
                            }else{
                              echo $categoryName;
                            }
                            ?>
                            </td>
                            <td><?=$productPrice?></td>
                            <td>   <?php
                                if ($sumamo==0){
                                  echo "หมด";
                                }else if($sumamo<=2){
                                  echo $sumamo." <span class='badge badge-danger'>เหลือน้อย</span> ";          
                                }else{
                                  echo $sumamo;
                                }
                              ?> 
                            </td>
                            <td><a href='productedit.php?id_prod=<?=$productID?>'>แก้ไข </a>
                            |<a href='productdel.php?id_del=<?=$productID?>'> ยกเลิก</a></td>
                          </tr>
          
          <?php
                        }else{
                        $showdanger='';
                      }
                  ?>
                <?    }
                } ?>
                  </table>

<table width='100%' class="table table-hover small table-sm "><tr class='text-center'>
          <th width='10%'><b>ลำดับ</b></th>
          <th width='20%'><b>ชื่อพัสดุ</b></th>
          <th width='20%'><b>บัญชี/ โครงการ</b></th>
          <th width='10%'><b>ราคา</b></th>
          <th width='10%'><b>จำนวน</b></th>
          <th width='20%'><b>แก้ไข</b></th>
        </tr>
   <?php
        $result = mysql_db_query($dbname,$sql);
        while($row = mysql_fetch_array($result)){ 
          $productID = $row["id"];	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
          $productName = $row["productName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
          $productPrice = $row["price"]; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
          $categoryID = $row["categoryID"]; 
          $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 "; 
          $result2 = mysql_db_query($dbname,$sql2);
          while($row2 = mysql_fetch_array($result2)){ 
            $sumamo=number_format($row2["sumamo"]);
            if ($sumamo==0){
              $showdanger='alert alert-danger';
            
              }else if($sumamo<=2){
                $showdanger='alert alert-warning ';
              }else{
              $showdanger='';
?>
                <tr class='text-center <?=$showdanger;?>'>
                  <td ><?php echo $num=$num+1;            ?></td>
                  <td class="text-left" ><?php 
                        echo "<a href='orderdetail.php?productid=" . $productID . "'>" . $productName . "</a>";
                  ?></td>
                  <td>
                  <?php 
                  $sqlcate = "select * from tb_category where categoryID='$categoryID';"; // ดึงข้อมูลจากตาราง product
                  $resultcate = mysql_db_query($dbname, $sqlcate);
                  while ($rowcate = mysql_fetch_array($resultcate)) {
                    $categoryName = $rowcate["categoryName"];	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
                  } 
                  if($categoryID==0){
                    echo "<span class='badge badge-danger'>กำหนด บัญชี/โครงการ</span> ";
                  }else{
                    echo $categoryName;
                  }
                  ?>
                  </td>
                  <td><?=$productPrice?></td>
                  <td>   <?php
                      if ($sumamo==0){
                        echo "หมด";
                      }else if($sumamo<=2){
                        echo $sumamo." <span class='badge badge-danger'>เหลือน้อย</span> ";          
                      }else{
                        echo $sumamo;
                      }
                    ?> 
                  </td>
                  <td><a href='productedit.php?id_prod=<?=$productID?>'>แก้ไข </a>
                  |<a href='productdel.php?id_del=<?=$productID?>'> ยกเลิก</a></td>
                </tr>
<?php
            }
           }
      } 
        mysql_close($Conn);
    }?>
        </table>
        <? 
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
