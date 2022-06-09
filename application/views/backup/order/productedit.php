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
    <h1>แก้ไข รายการพัสดุ</h1>


	<FORM method='post'class="form-inline" ACTION="..\order\productupdate.php" >
  
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width='60%'>รายการพัสดุ</th>
        <th width='20%'>ราคาพัสดุ</th>
        <th width='20%'>บัญชี/โครงการ</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $id=$_GET['id_prod'];
        include "../config/connect.php";  // เรียกไฟล์สำหรับจัดการเชื่อมต่อฐานข้อมูล MySQL
        $sql = "select * from tb_product where id='$id'"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname,$sql);
        while($row = mysql_fetch_array($result)){ 
          $getcateid=$row['categoryID'];
        ?>
      <tr>
        <td>    
        <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ข้อมูลพัสดุ" 
          name="add_product" value="<?php echo $row['productName'];?>">
        </td>
        <td>      
          <input type="text" class="form-control  mb-2 mr-sm-2"  placeholder="ระบุตัวเลข(บาท)" 
          value="<?php echo $row['price'];?>"   name="add_price">
          <input type="hidden" name='id_prod' value='<?php echo $row['id'];?>'>
        <?php } ?>
        </td>
<td> <select class="form-control  mb-2 mr-sm-2"  name="categoryID"  style="width:100%;" >
              <?php
              $sql2 = "select * from tb_category where catestatus='0' order by categoryName"; // ดึงข้อมูลจากตาราง product
              $result2 = mysql_db_query($dbname, $sql2);

              while ($row2 = mysql_fetch_array($result2)) {
                $categoryID = $row2["categoryID"];
                $categoryName = $row2["categoryName"];
                if ($categoryID==$getcateid){
                  $selec="selected";
                }else{
                  $selec="";
                }
                echo "<option value='" . $categoryID . "' $selec>" . $categoryName . "</option>";
              }
              ?>
              </select> 
          <input type="hidden" name='id_cate' value='<?php echo $row['categoryID'];?>'></td>

      </tr>
    </tbody>
  </table>    

   <div class="form-row col-md-12">
              <div class="form-group col-md-6">
        <a class="btn btn-danger  btn-block" href="addproduct.php">ยกเลิก</a>
              </div>
              <div class="form-group col-md-6">
        <button type="submit" class="btn btn-warning  btn-block">บันทึกการแก้ไข</button>
              </div>
          </FORM>
            </div>

</FORM>



   </div>
    <div class="col-md-1"></div>
  </div>
</div>

<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
