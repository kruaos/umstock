
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-12">

    <h1>เพิ่ม ร้านค้า</h1>

<?php 
foreach ($quary as $rs) {}
?>
  <FORM method='post'class="form-inline" ACTION="<?php echo site_url('seller/sel_update');?>" >
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width='50%'>ชื่อ ร้านค้า</th>
        <th width='50%'>ที่อยู่</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2" value="<?php echo $rs->sellerName;?>" 
          name="sellerName">
        </td>
        <td>      
        <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"   value="<?php echo $rs->sellerAddress;?>" 
          name="sellerAddress" >
          <input type="hidden" name="sellerID" value="<?php echo $rs->sellerID;?>">
          
        </td>
      </tr>
    </tbody>
  </table>      
     <div class="form-row col-md-12">
              <div class="form-group col-md-6">
              <a class="btn btn-danger  btn-block" href='<?php echo site_url('order/seller');?>'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
              <button type="submit" class="btn btn-success  btn-block">บันทึกข้อมูล</button>
              </div>
          </FORM>
        </div>
    


     </div>
  </div>
</div>
