<div class="container" style="margin-top:70px">
  <div class="row">
    <div class="col-md-12">
     <h1>แก้ไขแผนงาน </h1>

  <FORM method='post'class="form-inline" ACTION="<?PHP echo site_url('plan/plan_update');?>" >
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width='60%'>แผนงาน</th>
        <!-- <th width='20%'>หน่วยรับผิดชอบ</th> -->
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php 
        $planid=$this->uri->segment(3);

        $sql = "select * from tb_plan where planid='$planid';"; // ดึงข้อมูลจากตาราง product
        $result = $this->db->query($sql);
        foreach ($result->result() as $row) {
?>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  value='<?php echo $row->planname;?>' name="add_planname">
          <input type="hidden" value="<?php echo $planid;?>" name="planid">
        </td>
<!--         <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  value='<?php echo $row->deparmentID;?>' name="add_department">
          <input type="hidden" name='planid' value='<?php echo $row->planid;?>'>
        </td> -->
      </tr>
    </tbody>
        <?php } ?>    
  </table>      


          <div class="form-row col-md-12">
              <div class="form-group col-md-6">
                <a class="btn btn-danger  btn-block" href='<?PHP echo site_url('order/plan');?>'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success  btn-block">บันทึกข้อมูล</button>
              </div>
          </FORM>
            </div>

    </div>
  </div>
</div>