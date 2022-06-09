<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-12">
    <h1>เพิ่มแผนงาน </h1>


	<FORM method='post'class="form-inline" ACTION="<?php echo site_url('plan/plan_add');?>" >
  <table class="table table-bordered  small table-sm ">
    <thead>
      <tr>
        <th width='60%'>ชื่อ แผนงาน</th>
        <th width='40%'>หน่วยรับผิดชอบ</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>      
          <input type="text" style="width:100%;" class="form-control  mb-2 mr-sm-2"  placeholder="ชื่อแฟ้ม หรือ ประเภทที่ต้องการ" 
          name="add_planname">
        </td>
        <td>
        <select class="form-control  mb-2 mr-sm-2"  name="add_department"  style="width:100%;" >
        <?php

        $sql2 = "select * from tb_department where statusDepa='3' order by departmentID;"; // ดึงข้อมูลจากตาราง product
        $result2 = $this->db->query($sql2);
        foreach ($result2->result() as $row2) {
          $departmentID = $row2->departmentID;
          $departmentName = $row2->departmentName;
          $rootDepaID = $row2->rootDepaID;

          $sql3 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
          $result3 = $this->db->query($sql3);
          foreach ($result3->result() as $row3) {            
            $rootDepaName = $row3->departmentName;
            echo "<option value='" . $departmentID . "' >งาน" . $departmentName . " [ " . $rootDepaName . " - " . $rootDepaName . " ]" . "</option>";
          }
        }
        ?>
        </select> 
          
        </td>
      </tr>
    </tbody>
    </table> 

          <div class="form-row col-md-12">
              <div class="form-group col-md-6">
                <a class="btn btn-danger  btn-block" href='<?PHP echo site_url();?>'>ย้อนกลับ</a>
              </div>
              <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary  btn-block">บันทึกข้อมูล</button>
              </div>
          </FORM>
            </div>



    <?php
    $sql = "select * from tb_plan where planstatus='0' order by planid;"; // ดึงข้อมูลจากตาราง product
    $result = $this->db->query($sql);
    ?>
    <table class="table table-hover   table-sm " ><tr >
          <th width='5%'><b>ลำดับ</b></th>
          <th width='40%'><b>ชื่อ แผนงาน</b></th>
          <th width='30%'><b>หน่วยรับผิดชอบ</b></th>
          <th width='10%'><b>แก้ไข</b></th>
        </tr>

    <?php
    $num =0;
    foreach ($result->result() as $row) {
      $planid = $row->planid;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $planname = $row->planname;	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $deparmentID = $row->deparmentID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      ?>
    <tr>
      <td><?php 
          $num = $num + 1;
          echo $num;
          ?></td>
      <td><?php echo $planname ?></td>
      <td><?php 

          $sql4 = "select * from tb_department where departmentID=$deparmentID and statusDepa='3' order by departmentID;"; // ดึงข้อมูลจากตาราง product
           $result4 = $this->db->query($sql4);
           foreach ($result4->result() as $row4) {   
            $departmentName = $row4->departmentName;
            $rootDepaID = $row4->rootDepaID;

            $sql5 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
            $result5 = $this->db->query($sql5);
            foreach ($result5->result() as $row5) {   
              $rootDepaName = $row5->departmentName;
              $subDepaID = $row5->rootDepaID;

              $sql6 = "select * from tb_department where departmentID='$subDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
               $result6 = $this->db->query($sql6);
               foreach ($result6->result() as $row6) {   
                $subDepaName = $row6->departmentName;
              }
              echo "งาน" . $departmentName . " [ ฝ่าย" . $rootDepaName . " - " . $subDepaName . " ]";
            }
          }
          ?></td>
      <td>
        <a href='<?PHP echo site_url('plan/plan_edit/').$planid;?>'>แก้ไข </a>|
        <a href='<?PHP echo site_url('plan/plan_del/').$planid;?>'> ยกเลิก</a>
      </td>
    </tr>

<?php
    } 

    ?>
        </table>

    </div>
  </div>
</div>