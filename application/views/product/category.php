
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
    <h1>เพิ่ม บัญชี/โครงการ</h1>


	<FORM method='post'class="form-inline" ACTION="<?php echo site_url('/product/categoryinput'); ?>" >
  <table class="table table-bordered small table-sm ">
    <thead>
      <tr>
        <th width='60%'>ชื่อ บัญชี/โครงการ</th>
        <th width='40%'>แผนงาน</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ชื่อ บัญชี/โครงการ" 
          name="add_category">
        </td>
        <td>      
              <select class="form-control  mb-2 mr-sm-2"  name="planid"  style="width:100%;" >
              <?php

              $sql2 = "select * from tb_plan where planstatus='0' order by planname;"; // ดึงข้อมูลจากตาราง product
              $result2 = $this->db->query($sql2);
              foreach ($result2->result() as $row2) {
                $planname = $row2->planname;
                $planid = $row2->planid;
                echo "<option value='" . $planid . "' >" . $planname . "</option>";
              }
              ?>
              </select> 
          
        </td>
      </tr>
    </tbody>
  </table>   
</div>
     <div class="form-row col-md-12">
              <div class="form-group col-md-6">
              <a class="btn btn-danger  btn-block" href='<?php echo base_url();?>'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
              </div>
          </FORM>
            </div>


    <?php
    $num=0;
    $sql = "select * from tb_category where catestatus='0';"; // ดึงข้อมูลจากตาราง product
    $result = $this->db->query($sql);

    ?>
    <table class="table table-hover  small table-sm " ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='30%'><b>บัญชี/โครงการ</b></th>
          <th width='20%'><b>แผนงาน</b></th>
          <th width='30%'><b>หน่วยรับผิดชอบ</b></th>
          <th width='15%'><b>แก้ไข</b></th>
        </tr>

    <?php
    foreach ($result->result() as $row){
      $categoryID = $row->categoryID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $categoryName = $row->categoryName;	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $planID = $row->planID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

      ?>
    <tr>
      <td><?php 

          $num = $num + 1;
          echo $num;
          ?></td>
      <td><?php echo $categoryName ?></td>
      <td>
      <?php
      $sql9 = "select * from tb_plan where planid='$planID' ;"; // ดึงข้อมูลจากตาราง product
      $result9 = $this->db->query($sql9);
      foreach ($result9->result() as $row9){
        $planname = $row9->planname;
        $planid = $row9->planid;
        $deparmentID = $row9->deparmentID;

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
          $result4 = $this->db->query($sql4);
          foreach ($result4->result() as $row4){
            $departmentName = $row4->departmentName;
            $rootDepaID = $row4->rootDepaID;

            $sql5 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
            $result5 = $this->db->query($sql5);

            foreach ($result5->result() as $row5){
              $rootDepaName = $row5->departmentName;
              $subDepaID = $row5->rootDepaID;

              $sql6 = "select * from tb_department where departmentID='$subDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
              $result6 = $this->db->query($sql6);

              foreach ($result6->result() as $row6){
                $subDepaName = $row6->departmentName;
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
      <td><a href='categoryedit.php?id_cate=<?= $categoryID ?>'>แก้ไข </a>|<a href='categorydel.php?id_del=<?= $categoryID ?>'> ยกเลิก</a></center></td>

    </tr>

      <?php
    }
     ?>
        </table>
</div>