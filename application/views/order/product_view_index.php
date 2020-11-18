<?php
 $cateID=$this->uri->segment(3);
    $sql4 = "select * from tb_category where categoryID=$cateID  order by categoryName"; // 
    $result4 = $this->db->query($sql4);
    foreach ($result4->result() as $rsname) {
      $namecategory=$rsname->categoryName;
      $categoryID=$rsname->categoryID;
    }
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-12">
    <h3>เพิ่มรายการพัสดุ บัญชี <?php echo $namecategory; ?></h3>


  <FORM method='post'class="form-inline" ACTION="<?PHP echo site_url('product/add_product'); ?>" >
  <table class="table table-bordered small table-sm ">
    <thead>
      <tr>
        <th width='60%'>รายการพัสดุ</th>
        <th width='20%'>ราคาพัสดุ</th>
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
          <input type="hidden" value="<?php echo $categoryID; ?>" name="categoryID">
        </td>
      </tr>
    </tbody>
  </table> 
        <div class="form-row col-md-12">
              <div class="form-group col-md-6">
              <a class="btn btn-danger  btn-block" href='<?php echo site_url('');?>'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary  btn-block">เพิ่มรายการพัสดุ</button>
              </div>
          </FORM>
    </div>
  </div>
</div>


  <table width='100%' class="table table-hover  small table-sm ">
    <tr class='text-center'>
          <th width='10%'><b>ลำดับ</b></th>
          <th width='20%'><b>ชื่อพัสดุ</b></th>
          <th width='10%'><b>ราคา</b></th>
          <th width='10%'><b>จำนวน</b></th>
          <th width='20%'><b>แก้ไข</b></th>
        </tr>
   <?php
   $num=0;
    $sql = "select * from tb_product where statusproduct='0'  and categoryID=$cateID  order by productname "; // ดึงข้อมูลจากตาราง product
    $result = $this->db->query($sql);
    foreach ($result->result() as $row) {
    $productID = $row->id;    // เก็บรหัสสินค้าไว้ในตัวแปร $productID
    $productName = $row->productName;   // เก็บชื่อสินค้าไว้ในตัวแปร $productName
    $productPrice = $row->price; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
    $categoryID = $row->categoryID; 
        $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 "; 
        $result2 = $this->db->query($sql2);
        foreach ($result2->result() as $row2) {
            $sumamo=$row2->sumamo;
            if ($sumamo==0){
              $showdanger='alert alert-danger';
            }else if($sumamo<=2){
              $showdanger='alert alert-warning';
            }else if($sumamo>=3){
              $showdanger=' ';
            }
          }
?>
      <tr class='text-center <?php echo $showdanger;?>'>
        <td ><?php echo $num=$num+1;            ?></td>
        <td class="text-left" >
          <?php 
          echo "<a href='orderdetail.php?productid=" . $productID . "'>" . $productName . "</a>";
          ?>
        </td>
        <td><?php echo number_format($productPrice,2)?></td>
        <td>   <?php
            if ($sumamo==0){
              echo "<span class=' badge-danger'>หมด</span>";
            }else if($sumamo<=2){
              echo " <span class=' badge-warning'> เหลือ ".number_format($sumamo,2)." ชิ้น</span> ";          
            }else{
              echo number_format($sumamo,2);
            }
          ?> 
        </td>
        <td>
          <a href='<?php echo site_url('product/edit/'); ?><?php echo $productID?>'>แก้ไข </a> | 
          <a href='<?php echo site_url('product/del/'); ?><?php echo $productID?>'> ยกเลิก</a>
        </td>
      </tr>
<?php
          }
?>
        </table>