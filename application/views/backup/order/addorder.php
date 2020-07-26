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
$cateID=$_GET['categoryID'];
if($cateID==null){
?>
<?php
    include "../config/connect.php";
    $sql = "select * from tb_category where catestatus='0';"; // ดึงข้อมูลจากตาราง product
    $result = mysql_db_query($dbname, $sql);
    ?>
    <table class="table table-hover  table-sm " ><tr >
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
      <td><a href="addorder.php?categoryID=<?php echo $categoryID;?>"><?= $categoryName ?></a></td>
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
        </table>
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
    <div class="col-xs-1"></div>
    <div class="col-sm-12 col-md-12 col-xs-12">
    <h1>เพิ่มรายการบัญชีพัสดุ</h1>

<form method='post' action="../order/addorderinput.php">

  <div class="form-row">
  <div class="form-group col-md-2 ">
      <label for="inputEmail4">วันที่</label>
      <input name='dateOrder'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
    </div>
    <div class="form-group col-md-4">
          <label for="inputEmail4">บัญชี / โครงการ <a  href='categoryadd.php'>[เพิ่ม]</a></label>
      <select class="form-control" id="sel1" name='categoryID'>
        <?php
        include "../config/connect.php";
        $sql3 = "select * from tb_category where catestatus='0' and categoryID=$cateID and planID<>0 order by categoryID;"; // ดึงข้อมูลจากตาราง product
        $result3 = mysql_db_query($dbname, $sql3);
        
        while ($row3 = mysql_fetch_array($result3)) {
          $categoryID = $row3["categoryID"];
          $categoryName = $row3["categoryName"];
          echo "<option value='" . $categoryID . "'>" . $categoryName . "</option>";
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
              echo "<option value='" . $sellerID . "'>" . $sellerName . "</option>";
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
          echo "<option value='" . $cusid . "'> [" . $cusid . '] ' . $customerName . "</option>";
        }
        ?>
        </select>    </div>
  </div>
  <div class="form-row ">
          <div class="form-group col-md-4">
            <label for="inputAddress">เลขใบรับพัสดุ</label>
            <input type="text" class="form-control"  placeholder="ระบุ" name='NumProductID' class="form-control" id="text">
          </div>
          <div class="form-group col-md-4">
            <label >พัสดุ <a href='addproduct.php?categoryID=<?php echo $cateID;?> '>[เพิ่ม]</a></label> 
            <select class="form-control" id="sel1" name='productID'>
                <?php
                $sql = "select * from tb_product where statusproduct=0 and categoryID=$cateID order by productname"; // ดึงข้อมูลจากตาราง product
                $result = mysql_db_query($dbname, $sql);

                while ($row = mysql_fetch_array($result)) {
                  $productName = $row["productName"];
                  $productprice = $row["price"];
                  echo "<option value='" . $row["id"] . "'>" . $productName . " [" . $productprice . " บาท]" . "</option>";
                }
                ?>
                </select>    
          </div>
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
  <div class="form-row ">
    <a href="addorder.php" class="btn btn-danger col">ยกเลิก</a>
    <button type="submit" class="btn btn-warning col">บันทึกรายการ</button>
  </div>
</form>

    <h3>สถานะการบันทึกบัญชี</h3>
    <?php 
 $perpage = 50;
 $sql5 = "select * from tb_orderfile where statusfile='0' and categoryID=$cateID order by createdate DESC";
 $query5 = mysql_db_query($dbname, $sql5);
 $total_record = mysql_num_rows($query5);
 $total_page = ceil($total_record / $perpage);
?>
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

    <table  class="table table-hover  small table-sm  "><tr class='text-center'>
          <th width='10%'class='text-center'>วันที่ </th>
          <th >พัสดุ</th>
          <th >รายการ</th>
          <th width='5%' style="background-color:MediumSeaGreen;">รับ</th>
          <th width='5%' style="background-color:MediumSeaGreen;">ราคา</th>
          <th width='5%' style="background-color:MediumSeaGreen;">รวม</th>
          <th width='5%' style="background-color:Tomato;">จ่าย</th>
          <th width='5%' style="background-color:Tomato;">ราคา</th>
          <th width='5%' style="background-color:Tomato;">รวม</th>
          <th width='10%'>แก้ไข</th>
        </tr>
        <?php
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }        
    $startpage = ($page - 1) * $perpage;

        $sql = "select * from tb_orderfile where statusfile='0' and categoryID=$cateID order by createdate DESC limit {$startpage} , {$perpage} ;"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname, $sql);
        while ($row = mysql_fetch_array($result)) {
      ?>
    <tr>
      <td class='text-center'><?php 
                              $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
                              $showdate = number_format(substr($row["createdate"], 8, 2)) . " " . $showmont[number_format(substr($row["createdate"], 5, 2)) - 1] . " " . (substr($row["createdate"], 2, 2) + 43);
                              echo $showdate;
                              ?></td>
      <td><?php 
          $productID = $row["productID"];
          $cusid = $row["cusid"];
          $categoryID = $row["categoryID"];
          $sql1 = "select * from tb_product where id=$productID";
          $result1 = mysql_db_query($dbname, $sql1);
          while ($row1 = mysql_fetch_array($result1)) {
            $productName = $row1["productName"];
            $productprice = $row1["price"];
          }
          $sql2 = "select * from tb_customer where cusid=$cusid";
          $result2 = mysql_db_query($dbname, $sql2);
          while ($row2 = mysql_fetch_array($result2)) {
            $fullname = $row2["fullname"];
          }

          echo "<a href='orderdetail.php?productid=" . $productID . "'>" . $productName . "</a>"; ?></td>
      <td>
    
      <?php 
            $cusid=$row["cusid"];
            $sql7 = "select * from tb_customer where cusid=$cusid"; // ดึงข้อมูลจากตาราง product
            $result7 = mysql_db_query($dbname,$sql7);
            while($row7 = mysql_fetch_array($result7)){ 
              $cusfullname = $row7["fullname"];
            }
            $sellerID=$row["sellerID"];
            $sql8 = "select * from tb_seller where sellerID=$sellerID"; // ดึงข้อมูลจากตาราง product
            $result8 = mysql_db_query($dbname,$sql8);
            while($row8 = mysql_fetch_array($result8)){ 
              $sellerName = $row8["sellerName"];
            }
            
            
            if ($row["statusOrder"]=='in'){
              echo  $sellerName.$row["detail"];;
            }else if($row["detail"]==null){
              echo  $cusfullname;
            }else{
              echo $row["detail"];
            }
            
 ?>
    
    </td>
      <?php 
      $amountcheck = $row["statusOrder"];
      if ($amountcheck == 'ou') {
        $de1 = "";
        $de2 = "";
        $de3 = "";
        $wi1 = abs($row["amount"]);
        $wi2 = $productprice;
        $wi3 = number_format($wi1 * $wi2);
      } else {
        $de1 = $row["amount"];
        $de2 = $productprice;
        $de3 = number_format($de1 * $de2);
        $wi1 = "";
        $wi2 = "";
        $wi3 = "";
      } ?>
      <td style="text-align:right;" ><?php echo $de1; ?></td>
      <td style="text-align:right;" ><?php echo $de2; ?></td>
      <td style="text-align:right;" ><?php echo $de3; ?></td>
      <td style="text-align:right;" ><?php echo $wi1; ?></td>
      <td style="text-align:right;" ><?php echo $wi2; ?></td>
      <td style="text-align:right;" ><?php echo $wi3; ?></td>
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
      }
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
