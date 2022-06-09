<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>ระบบรายการเบิกพัสดุ</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h5>
        <label>ของ <?php echo $this->session->userdata('fullname'); ?> </label>
        <label>ประเภท <?php foreach ($query as $rs) {
                        $categoryID = $rs->categoryID;
                        echo $rs->categoryName;
                      } ?> </label>
      </h5>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover table-sm  ">
        <tr class='text-center  alert-success '>
          <th width='20'><b>No.</b></th>
          <th width='400'><b>รายการพัสดุต้องการ </b></th>
          <th width='100'>จำนวน </th>
          <th width='200' class='text-center'><b>เพิ่ม</b> </th>
        </tr>
        <?php
        $num = 1;
        foreach ($rsOut as $data) {
          echo "<tr class='text-center'>";
          echo "<td >" . $num++ . "</td>";
          echo "<label><td >" . $data->productName . " </label><label> [ " . $data->price . " บาท ]</label> </td>";

          echo "<td >" . $data->quantity . "</td>";
        ?>
          <td>
            <a href="<?php echo site_url('order/UserUnbookOrder/') . $this->uri->segment(3) . '/' . $data->id . '/' . $this->uri->segment(5); ?>" class="btn btn-warning btn-sm">ลด</a>
          </td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form method='post' action="<?php echo site_url('order/userAddOrder'); ?>">
        <div class="form-row">
          <div class="form-group col-md-2 ">
            <label>วันที่</label>
            <input name='dateOrder' id="inputdatepicker" class="form-control datepicker  form-control-sm">
          </div>
          <div class="form-group col-md-2 ">
            <label>ต้องการภายในวันที่</label>
            <input name='dayneed' id="inputdatepicker" class="form-control datepicker  form-control-sm">
          </div>
          <div class="form-group col-md-8 ">
            <label>รายละเอียด</label>
            <input name='explain' type="text" class="form-control  form-control-sm" placeholder="เพื่อ......">
            <input type="hidden" name="categoryID" value="<?php echo $this->uri->segment(3); ?>">
          </div>
        </div>

        <div class="btn-group col" role="group">
          <a class="btn btn-danger col" href='<?php echo site_url('order/basket'); ?>'>ย้อนกลับ</a>
          <a class="btn btn-secondary col" href='<?php echo site_url('order/UserclearbookOrder/') . $categoryID; ?>'>ยกเลิก</a>
          <button type="submit" class="btn btn-primary  col">บันทึกข้อมูล</button>
        </div>
      </form>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">

      <table id="example" class="table table-striped table-sm  ">
        <thead>
          <tr class='text-center table-danger  '>
            <th width='50'><b>No.</b></th>
            <th width='300'><b>รายการพัสดุที่มี </b></th>
            <th width='100'>จำนวน </th>
            <th width='300' class='text-center'><b>เพิ่ม</b> </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $num = 1 + ($this->uri->segment(4));
          foreach ($rsIn as $data) {
            echo "<tr class='text-center'>";
            echo "<td >" .  $num++ . "</td>";
            echo "<td >" . $data->productName . " [ " . $data->price . " บาท ]</td>";

            $sqlOut = 'SELECT * from tb_basket where productID=' . $data->id . ' and memberID=' . $this->session->userdata('userid');
            $resultOut = $this->db->query($sqlOut);
            // print_r($resultOut);
            $productID = $data->id;
            $sqlIn = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 ";
            $resultIn = $this->db->query($sqlIn);

            if ($resultOut->num_rows() <> 0) {
              $proOut = $resultOut->row()->quantity;
              $proIn = $resultIn->row()->sumamo;
              $countshow = $proIn - $proOut;
            } else {
              $countshow = $resultIn->row()->sumamo;
            }

            echo "<td >" . $countshow . "</td>";
          ?>
            <form method="POST" action="<?php echo site_url('order/UserbookOrder/'); ?>">
              <td>
                <?php if ($countshow <= 0) { ?>
                  <a href='' class="btn btn-danger btn-sm disabled">หมด</a>
                <?php } else { ?>
                  <select class="form-control-sm col-3" name="amount_by_product">
                    <?php
                    for ($c_i = 1; $c_i <= $countshow; $c_i++) {
                    ?>
                      <option><?php echo $c_i; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                  <input type="hidden" name="categoryID" value="<?php echo $categoryID; ?>">
                  <input type="hidden" name="product_id" value="<?php echo $productID; ?>">
                  <button type="submit" class="btn btn-success btn-sm col-3">เพิ่ม</button>
                  <button type="reset" class="btn btn-secondary  btn-sm col-3">ล้าง</button>
                <?php } ?>
              </td>
            </form>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>