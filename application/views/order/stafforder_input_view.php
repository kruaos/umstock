
<?php 

  $cateID=$this->uri->segment(3);
  $sql3 = "select * from tb_category where catestatus='0' and categoryID=$cateID and planID<>0 order by categoryID;"; // ดึงข้อมูลจากตาราง product
  $result3 = $this->db->query($sql3);
  foreach ($result3->result() as $row3) {
          $categoryID = $row3->categoryID;
          $categoryName = $row3->categoryName;
  }


?>
<div class="container col-md-12">
<h1>เพิ่มรายการบัญชีพัสดุ</h1>
  
  <form method='post' action="<?php echo site_url('order/staff_add_order');?>">

    <div class="form-row ">
      <div class="form-group col-md-2 ">
        <label for="inputEmail4">วันที่</label>
        <input name='dateOrder'  id="inputdatepicker" class="form-control datepicker" data-date-format="mm/dd/yyyy ">
      </div>
      <div class="form-group col-md-4">
            <label for="inputEmail4">บัญชี / โครงการ <a  href='<?php echo site_url('order/plan');?>'>[เพิ่ม]</a></label>
        <select class="form-control" id="sel1" name='categoryID'>
          <?php
          $sql3 = "select * from tb_category where catestatus='0' and categoryID=$cateID and planID<>0 order by categoryID;"; // ดึงข้อมูลจากตาราง product
            echo "<option value='" . $categoryID . "'>" . $categoryName . "</option>";
          ?>
          </select>

      </div>
          <div class="form-group col-md-3">
                <label>รับ <a  href="<?php echo site_url('order/seller');?>">[เพิ่ม]</a></label>
      
            <select class="form-control"  name='sellerID'>
              <?php
              $sql4 = "select * from tb_seller where sellerStatus<>'0' order by sellerName;"; // ดึงข้อมูลจากตาราง product
              $result4 = $this->db->query($sql4);
              foreach ($result4->result() as $row4) {
                $sellerID = $row4->sellerID;
                $sellerName = $row4->sellerName;
                echo "<option value='" . $sellerID . "'>" . $sellerName . "</option>";
              }
              ?>
              </select>
      
          </div>

      <div class="form-group col-md-3">
        <label for="inputPassword4">จ่าย <a  href='#'>[ผู้ขอเบิก]</a></label>

          <select class="form-control" id="sel1" name='cusid'>
          <?php
          $sql5 = "select * from tb_customer where status='1'  order by cusid;"; // ดึงข้อมูลจากตาราง product
              $result5 = $this->db->query($sql5);
              foreach ($result5->result() as $row5) {
            $customerName = $row5->fullname;
            $cusid = $row5->cusid;
            echo "<option value='" . $cusid . "'> [" . $cusid . '] ' . $customerName . "</option>";
          }
          ?>
          </select>    
        </div>
    </div>


    <div class="form-row ">
            <div class="form-group col-md-4">
              <label for="inputAddress">เลขใบรับพัสดุ</label>
              <input type="text" class="form-control"  placeholder="ระบุ" name='NumProductID' class="form-control" id="text">
            </div>
            <div class="form-group col-md-4">
              <label >พัสดุ <a href="<?php echo site_url('order/staff_add_order');?><?php echo $cateID;?> ">[เพิ่ม]</a></label> 
              <select class="form-control" id="sel1" name='productID'>
                  <?php
                  $sql6 = "select * from tb_product where statusproduct=0 and categoryID=$cateID order by productname"; // ดึงข้อมูลจากตาราง product
                  $result6 = $this->db->query($sql6);
              foreach ($result6->result() as $row6) {
                    $productName = $row6->productName;
                    $productprice = $row6->price;
                    $productid=$row6->id;
                    echo "<option value='" . $productid . "'>" . $productName . " [" . $productprice . " บาท]" . "</option>";
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

</div>

