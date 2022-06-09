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


</head>
<body> 
<?php 
include "../config/navmenu.php";
?>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-xs-1"></div>
    <div class="col-sm-12 col-md-12 col-xs-12">
    <h1>รายการสมาชิก</h1>

<form method='post' action="../order/addorderinput.php">

  <div class="form-row">
  <div class="form-group col-md-2 ">
      <label for="inputEmail4">วันที่</label>
      <input name='dateOrder'  class="form-control datepicker" >
    </div>
    <div class="form-group col-md-4">
          <label for="inputEmail4">บัญชี / โครงการ <a  href='categoryadd.php'>[เพิ่ม]</a></label>
      <select class="form-control" id="sel1" name='categoryID'>
        <?php
        include "../config/connect.php";
        $sql3 = "select * from tb_category where catestatus='0' and planID<>0 order by categoryID;"; // ดึงข้อมูลจากตาราง product
        $result3 = mysql_db_query($dbname, $sql3);
        
        while ($row3 = mysql_fetch_array($result3)) {
          $categoryID = $row3["categoryID"];
          $categoryName = $row3["categoryName"];
        //  echo "<option value='" . $categoryID . "'>" . $categoryName . "</option>";
        }
        ?>
        </select>

    </div>
        <div class="form-group col-md-3">
              <label for="inputEmail4">รับ <a  href='seller.php'>[เพิ่ม]</a></label>
    
          <select class="form-control"  name='sellerID'>
            <?php
            $sql4 = "select * from tb_seller where sellerStatus<>'0' order by sellerName;"; // ดึงข้อมูลจากตาราง product
            $result4 = mysql_db_query($dbname, $sql4);
    
            while ($row4 = mysql_fetch_array($result4)) {
              $sellerID = $row4["sellerID"];
              $sellerName = $row4["sellerName"];
            //  echo "<option value='" . $sellerID . "'>" . $sellerName . "</option>";
            }
            ?>
            </select>
    
        </div>

    <div class="form-group col-md-3">
      <label for="inputPassword4">จ่าย <a  href='#'>[ผู้ขอเบิก]</a></label>

        <select class="form-control" id="sel1" name='cusid'>
        <?php
        $sql = "select * from tb_customer where status='1'  order by cusid;"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname, $sql);

        while ($row = mysql_fetch_array($result)) {
          $customerName = $row["fullname"];
          $cusid = $row["cusid"];
        //  echo "<option value='" . $cusid . "'> [" . $cusid . '] ' . $customerName . "</option>";
        }
        ?>
        </select>    </div>
  </div>
  
  <div class="form-row ">
    <a href="addorder.php" class="btn btn-danger col">ยกเลิก</a>
    <button type="submit" class="btn btn-warning col">บันทึกรายการ</button>
  </div>
</form>

    <h3>สถานะการบันทึกบัญชี</h3>
    
    <table  class="table table-hover  small table-sm  "><tr class='text-center'>
          <th width='10%'class='text-center'>ที่ </th>
          <th width='200'>ชื่อ</th>
          <th >ตำแหน่ง</th>
          <th >ฝ่าย/งาน</th>
          <th >สำนัก/กอง</th>
          <th width='10%'>แก้ไข</th>
        </tr>
        <?php
        $sql = "select * from tb_customer where status='1' order by cusid asc "; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname, $sql);
        while ($row = mysql_fetch_array($result)) {
          $fullname = $row["fullname"];
      ?>
    <tr>
      <td class='text-center'>  </td>
      <td><?php echo $fullname;?></td>

      <td ></td>
      <td ></td>
      <td ></td>
      <td style="text-align:center;" >
      <a class="btn btn-primary btn-sm" href='addorderedit.php?idedit=<?php echo $row["orderFileID"];?>'><div class='small'>แก้ไข</div></a>
      <a class="btn btn-danger btn-sm" href='addorderdel.php?id_del=<?php echo $row["orderFileID"]; ?>&categoryID=<?php echo $categoryID;?>'><div class='small'>ลบ</div></a></td>
    </tr>  
      <?
    } ?>
        </table>
            <a class="btn  btn-secondary btn-sm" href="addorder.php?categoryID=<?php echo$cateID;?>&page=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            </a>
          <?php for($i=1;$i<=$total_page;$i++){ ?>
            <a class="btn  btn-secondary btn-sm" href="addorder.php?categoryID=<?php echo$cateID;?>&page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          <?php } ?>
          <a  class="btn  btn-secondary btn-sm" href="addorder.php?categoryID=<?php echo $cateID;?>&page=<?php echo $total_page;?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>
        <?
        mysql_close($Conn);
      
        ?>
    </div>
    <div class="col-xs-1"></div>
  </div>
</div>
<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
