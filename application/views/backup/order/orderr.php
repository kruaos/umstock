<?
include "../member/chksession.php";
date_default_timezone_set("Asia/Bangkok");
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
<link href="../config/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="../config/dist/js/bootstrap-datepicker-custom.js"></script>
<script src="../config/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true              //Set เป็นปี พ.ศ.
        }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
    });
</script>

</head>
<body> 
<?php 
  include "../config/navmenu.php";
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-xs-1"></div>
    <div class="col-sm-12 col-md-12 col-xs-12">
    <h1>เพิ่มรายการบัญชีพัสดุ</h1>

<form method='post' action="..\order\addorderinput.php">

  <div class="form-row">
  <div class="form-group col-md-2">
      <label for="inputEmail4">วันที่</label>
      <input name='dateOrder'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
      
      
    </div>
    <div class="form-group col-md-3">
          <label for="inputEmail4">แผนงาน <a  href='plan.php'>[เพิ่ม]</a></label>

      <select class="form-control"  name='planid'>
        <?php
          include "../config/connect.php";
          $sql4 = "select * from tb_plan where planstatus='0' order by planid;"; // ดึงข้อมูลจากตาราง product
          $result4 = mysql_db_query($dbname,$sql4);

          while($row4 = mysql_fetch_array($result4)){ 
            $planid = $row4["planid"];
            $planname=$row4["planname"];
            echo  "<option value='".$planid."'>".$planname."</option>";
          }
          ?>
        </select>

    </div>
    <div class="form-group col-md-3">
          <label for="inputEmail4">บัญชี / โครงการ <a  href='categoryadd.php'>[เพิ่ม]</a></label>
      <select class="form-control" id="sel1" name='customerid'>
        <?php
          include "../config/connect.php";
          $sql3 = "select * from tb_category where catestatus='0' order by categoryID;"; // ดึงข้อมูลจากตาราง product
          $result3 = mysql_db_query($dbname,$sql3);

          while($row3 = mysql_fetch_array($result3)){ 
            $categoryID = $row3["categoryID"];
            $categoryName=$row3["categoryName"];
            echo  "<option value='".$categoryID."'>".$categoryName."</option>";
          }
          ?>
        </select>

    </div>

    <div class="form-group col-md-4">
      <label for="inputPassword4">ของ(ผู้ขอเบิก)</label>

        <select class="form-control" id="sel1" name='cusid'>
        <?php
          include "../config/connect.php";
          $sql = "select * from tb_customer where status='1' and department='1' order by cusid;"; // ดึงข้อมูลจากตาราง product
          $result = mysql_db_query($dbname,$sql);

          while($row = mysql_fetch_array($result)){ 
            $customerName = $row["fullname"];
            $cusid=$row["cusid"];
            echo  "<option value='".$cusid."'> [".$cusid.'] '.$customerName."</option>";
          }
          ?>
        </select>    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="inputAddress">รายละเอียด</label>
    <input type="text" class="form-control"  placeholder="เพื่อ............" name='detail' class="form-control" id="text">
  </div>

    <div class="form-group col-md-4">
      <label >พัสดุ</label>
      <select class="form-control" id="sel1" name='productID'>
          <?php
          include "../config/connect.php";
                  $sql = "select * from tb_product where statusproduct=0 order by productname"; // ดึงข้อมูลจากตาราง product
                  $result = mysql_db_query($dbname,$sql);

                  while($row = mysql_fetch_array($result)){ 
                    $productName = $row["productName"];
                    $productprice= $row["price"];
                    echo "<option value='".$row["id"]."'>".$productName." [".$productprice." บาท]"."</option>";
                  }
            ?>
          </select>    </div>
    <div class="form-group col-md-2">
      <label >สถานะ</label>
      <select class="form-control" id="sel1" name='status'>
        <option value='in'>รับ</option>
        <option value='ou'>จ่าย</option>
        <option value='am'>ยอดยกมา</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">จำนวน</label>
      <input type="text" name='amount' class="form-control css-require" id="text" placeholder="ตัวเลข" >
          </div>
  </div>
  <button type="submit" class="btn btn-warning col-md">บันทึกรายการ</button>
</form>


  <?php
        include "../config/connect.php";
        $sql = "select * from tb_orderfile where statusfile='0' order by createdate DESC;"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname,$sql);
        ?>
    <h3>สถานะการบันทึกบัญชี</h3>

    <table width='100%' class="table table-hover table-sm  "><tr class='text-center'>
          <th width='10%'class='text-center'>วันที่ </th>
          <th width='20%'>รายการ</th>
          <th width='10%'>ของ</th>
          <th width='20%'>แผนงาน [บัญชี/โครงการ]</th>
          <th width='5%' style="background-color:MediumSeaGreen;">รับ</th>
          <th width='5%' style="background-color:MediumSeaGreen;">ราคา</th>
          <th width='5%' style="background-color:MediumSeaGreen;">รวม</th>
          <th width='5%' style="background-color:Tomato;">จ่าย</th>
          <th width='5%' style="background-color:Tomato;">ราคา</th>
          <th width='5%' style="background-color:Tomato;">รวม</th>
          <th width='10%'>แก้ไข</th>

        </tr>

    <?php
        while($row = mysql_fetch_array($result)){ 

    ?>
    <tr>
      <td class='text-center'><?php       
      $showmont=array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
      
      $showdate=number_format(substr($row["createdate"],8,2))." ".$showmont[number_format(substr($row["createdate"],5,2))-1]." ".(substr($row["createdate"],2,2)+43);
      echo $showdate;
      
      
      ?></td>
      <td><?php 
            $productID=$row["productID"];
            $cusid=$row["cusid"];
            $planid=$row['planid'];
            $categoryID=$row["categoryID"];
            $sql1 = "select * from tb_product where id=$productID"; 
            $result1 = mysql_db_query($dbname,$sql1);
            while($row1 = mysql_fetch_array($result1)){ 
              $productName = $row1["productName"];
              $productprice= $row1["price"];
            }
            $sql2 = "select * from tb_customer where cusid=$cusid";
            $result2 = mysql_db_query($dbname,$sql2);

            while($row2 = mysql_fetch_array($result2)){ 
              $fullname = $row2["fullname"];
            }
            $sql5 = "select * from tb_plan where planid=$planid"; 
            $result5 = mysql_db_query($dbname,$sql5);
            while($row5 = mysql_fetch_array($result5)){ 
              $planname = $row5["planname"];
            }
            $sql6 = "select * from tb_category where categoryID=$categoryID";
            $result6 = mysql_db_query($dbname,$sql6);
            while($row6 = mysql_fetch_array($result6)){ 
              $categoryname = $row6["categoryName"];
            }
            echo  "<a href='orderdetail.php?productid=".$productID."'>".$productName."</a>"; ?></td>
      <td><?php echo iconv_substr($fullname, 0,10, "UTF-8");?></td>
      <td><?php echo $planname."[".$categoryname."]";?></td>
      <?php 
          $amountcheck=$row["statusOrder"];
      if ($amountcheck=='ou'){
          $de1="";
          $de2="";
          $de3="";
          $wi1=$row["amount"];
          $wi2=$productprice;
          $wi3=number_format($wi1*$wi2);
      }else{
          $de1=$row["amount"];
          $de2=$productprice;
          $de3=number_format($de1*$de2);
          $wi1="";
          $wi2="";
          $wi3="";
        } ?>

      <td style="text-align:right;" ><?php echo  $de1; ?></td>
      <td style="text-align:right;" ><?php echo  $de2; ?></td>
      <td style="text-align:right;" ><?php echo  $de3; ?></td>
      <td style="text-align:right;" ><?php echo  $wi1; ?></td>
      <td style="text-align:right;" ><?php echo  $wi2; ?></td>
      <td style="text-align:right;" ><?php echo  $wi3; ?></td>
      <td style="text-align:center;" ><a class="btn btn-primary btn-sm" href='#'>แก้ไข</a>
      <a class="btn btn-danger btn-sm" href='addorderdel.php?id_del=<?php echo$row["orderFileID"];?>'>ลบ</a></td>
    </tr>

      <?    } ?>
        <table>
        <? 
        mysql_close($Conn);
        ?>


    </div>
    <div class="col-sx-1"></div>
  </div>
</div>
<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
