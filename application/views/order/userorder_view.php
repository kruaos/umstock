<div class="container  small"  >

  <div class="row ">
    <div class="col-md ">  
      <h1>ระบบรายการเบิกพัสดุ</h1><br>
      <h5>
        <label>ของ <?php echo $this->session->userdata('fullname');?> </label>
        <label>ประเภท <?php foreach ($query as $rs){echo $rs->categoryName;} ?> </label>
      </h5>
    </div>
</div>

<!-- ส่วนแสดงข้อมูลต่างๆ -->
 <div class="row">

    <div class="col-md-12"> 
    <table  class="table table-hover table-sm  ">
        <tr class='text-center  alert-warning '>
          <th width='20'><b>No.</b></th>
          <th width='400'><b>รายการพัสดุที่มี </b></th>
          <th width='100'>จำนวน </th>
          <th width='200'class='text-center'><b>เพิ่ม</b> </th>
        </tr>
           <?php
            $num=1+($this->uri->segment(4));
            foreach($rsIn as $data) {
            echo "<tr class='text-center'>";
                echo "<td >".  $num++."</td>";
              echo "<label><td >".$data->productName." </label><label> [ ".$data->price." บาท ]</label> </td>"; 

                  $sqlOut = 'select * from tb_basket where productID='.$data->id.' and memberID='.$this->session->userdata('userid');
                  $resultOut=$this->db->query($sqlOut);
                  // print_r($resultOut);
                  $productID=$data->id;
                  $sqlIn = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 ";
                  $resultIn=$this->db->query($sqlIn);

                  if($resultOut->num_rows()<>0) { 
                    $proOut=$resultOut->row()->quantity;
                    $proIn=$resultIn->row()->sumamo;
                    $countshow=$proIn-$proOut;
                    }else{
                    $countshow=$resultIn->row()->sumamo;
                    }
                    
                echo "<td >".$countshow."</td>"; 
              ?>
                  <td >
                  <?php if($countshow<>0) {?>
                    <a href="<?php echo site_url('order/UserbookOrder/').$this->uri->segment(3).'/'.$data->id.'/'.$this->uri->segment(5) ;?>" class="btn btn-success btn-sm">เพิ่ม</a>
                  <?php }else{ ?>
                    <a href='' class="btn btn-danger btn-sm disabled" >หมด</a>
                  <?php } ?>    
                  </td>
                </tr>
            <?php 
            }
            ?>
    </table>
    
    <p><?php echo $links;?></p>
    </div>
    
  <!-- รายการพัสดุที่ต้องการ -->
    <div class="col-md-12"> 
    <table  class="table table-hover table-sm  ">
       <tr class='text-center  alert-success '>
          <th width='20'><b>No.</b></th>
          <th width='400'><b>รายการพัสดุต้องการ </b></th>
          <th width='100'>จำนวน </th>
          <th width='200'class='text-center'><b>เพิ่ม</b> </th>
        </tr>
          <?php
          $num=1;
          foreach($rsOut as $data) {
              echo "<tr class='text-center'>";
              echo "<td >". $num++."</td>";
              echo "<label><td >".$data->productName." </label><label> [ ".$data->price." บาท ]</label> </td>"; 

              echo "<td >".$data->quantity."</td>";
            ?> 
                <td >
                    <a href="<?php echo site_url('order/UserUnbookOrder/').$this->uri->segment(3).'/'.$data->id.'/'.$this->uri->segment(5) ;?>" class="btn btn-warning btn-sm">ลด</a>
                </td>
              </tr>
          <?php 
          }
          ?> 
      </table>
    </div>

  </div>
<!-- --------------- ส่วน เพิ่ม ข้อมูล -->
  <div class="row ">
    <div class="col-md ">  
      <form method='post' action="<?php echo site_url('order/userAddOrder');?>">
      <div class="form-row">
          <div class="form-group  col-md-2 col-sm-6 col-xs-2  ">
            <label >วันที่</label>
            <input name='dateOrder'  id="inputdatepicker" class="form-control datepicker  form-control-sm">
          </div>
          <div class="form-group col-md-2 col-sm-6">
            <label >ต้องการภายในวันที่</label>
            <input name='dayneed'  id="inputdatepicker" class="form-control datepicker  form-control-sm" >
          </div>    
          <div class="form-group col-md-8">
            <label >รายละเอียด</label>
            <input name='explain' type="text" class="form-control  form-control-sm"  placeholder="เพื่อ......" >
            <<input type="hidden" name="categoryID" value="<?php echo $this->uri->segment(3) ;?>">
          </div>
          <div class="form-group col-md">
              <a class="btn btn-danger  btn-block" href='<?php echo site_url('order/basket');?>'>ย้อนกลับ</a>
          </div>
          <div class="form-group col-md">
              <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
          </div>
        </form>
      </div>
    </div>
</div>

</div>

     