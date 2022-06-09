<?php
    $productID=$this->uri->segment(3);
    $sql4 = "select * from tb_product, tb_category where id=$productID and tb_category.categoryID=tb_product.categoryID "; // 
    $result4 = $this->db->query($sql4);
    foreach ($result4->result() as $reproduct) {
      $productName=$reproduct->productName;
      $price=$reproduct->price;
      $categoryName=$reproduct->categoryName;
      $categoryID=$reproduct->categoryID;
    }
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-12">
    <h3>เพิ่มรายการพัสดุ บัญชี <?php echo $categoryName; ?></h3>


  <FORM method='post'class="form-inline" ACTION="<?PHP echo site_url('product/update_product'); ?>" >
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
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  value="<?php echo $productName ;?>" 
          name="productName">
        </td>
        <td>      
          <input type="text" style="width:100%;"  class="form-control  mb-2 mr-sm-2"  value="<?php echo $price ;?>" 
          name="add_price">
          <input type="hidden" value="<?php echo $productID; ?>" name="productID">
          <input type="hidden" value="<?php echo $categoryID; ?>" name="categoryID">
        </td>
      </tr>
    </tbody>
  </table> 
        <div class="form-row col-md-12">
              <div class="form-group col-md-6">
              <a class="btn btn-danger  btn-block" href='<?PHP echo site_url('order/product/').$categoryID;?>'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
              <button type="submit" class="btn btn-success  btn-block">บันทึกการแก้ไข</button>
              </div>
          </FORM>
    </div>
  </div>
</div>

