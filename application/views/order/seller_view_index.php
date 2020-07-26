
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-12">

    <h1>เพิ่ม ร้านค้า</h1>


  <FORM method='post'class="form-inline" ACTION="<?php echo site_url('seller/sel_add');?>" >
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
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ชื่อ ร้านค้า" 
          name="sellerName">
        </td>
        <td>      
        <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ที่อยู่ร้านค้า " 
          name="sellerAddress" >
          
        </td>
      </tr>
    </tbody>
  </table>      
     <div class="form-row col-md-12">
              <div class="form-group col-md-6">
              <a class="btn btn-danger  btn-block" href='<?php echo site_url('home/info');?>'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
              </div>
          </FORM>
        </div>
    

<?php
  $num = 0;
    $sql = "select * from tb_seller where sellerStatus<>'0';"; // ดึงข้อมูลจากตาราง product
    $result = $this->db->query($sql);
    ?>
    <table class="table table-hover  table-sm" ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='40%'><b>ชื่อ ร้านค้า </b></th>
          <th width='40%'><b>ที่อยู่</b></th>
          <th width='15%'><b>แก้ไข</b></th>
        </tr>

    <?php
    foreach ($result->result() as $row) {
      $sellerID = $row->sellerID;   // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $sellerName = $row->sellerName;   // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $sellerAddress = $row->sellerAddress;   // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      ?>
    <tr>
      <td><?php 
          $num = $num + 1;
          echo $num;
          ?></td>
      <td><?php echo $sellerName ;?></td>
      <td><?php echo $sellerAddress ;?></td>
      <td>
        <a href='<?php echo site_url('seller/sel_edit/'.$sellerID);?>'>แก้ไข </a>|
        <a href='<?php echo site_url('seller/sel_del/'.$sellerID);?>'> ยกเลิก</a>
      </td>
      
    </tr>
<?php 
    } 
?>
        <table>

     </div>
  </div>
</div>
