
<div class="container" style="margin-top:30px">
  <div class="row">

    <div class="col-md-12">
    <h1>เพิ่มกอง ฝ่าย งาน  </h1>
    <form method="POST" action="<?php echo site_url('members/department_add');?>">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">สำนัก/กอง</label>
          <div class="col">
          <input type="text" name="DepatName" class="form-control" placeholder="สำนัก/กอง">
          <input type="hidden" name="statusDepa" class="form-control"  value='1'>
          <input type="hidden" name="rootDepaID" class="form-control"  value='0'>

          </div>
            <div class="col-sm-2">
        <button type="submit" class="btn btn-primary">บันทึก สำนัก/กอง</button>
        </div>
    </div>
    </form>
<?php /*
    สถานะของกองฝ่าย statusDepa
    1 สำนัก / กอง 
    2 ฝ่าย 
    3 งาน/ โครงการ 
    0 ยกเลิก
 */ 

/*
  $query = $this->db->query($sql);
  foreach ($query->result() as $row) {
*/
    ?>

    <form method="POST" action="<?php echo site_url('members/department_add');?>">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">ฝ่าย</label>
        <div class="col-sm-4">
        <select class="form-control"  name='rootDepaID'>
        <?php
        $sql1 = "select * from tb_department where statusDepa='1' order by departmentID;"; // ดึงข้อมูลจากตาราง product
        $result1 = $this->db->query($sql1);
        foreach ($result1->result() as $row1) {
            $departmentID = $row1->departmentID;
            $departmentName = $row1->departmentName;
            echo "<option value='" . $departmentID . "' >" . $departmentName . "</option>";
        }
        ?>
        </select>
        </div>
        <div class="col-sm-4">
        <input type="text" name="DepatName" class="form-control"  placeholder="ฝ่าย">
        <input type="hidden" name="statusDepa" class="form-control"  value='2'>

        </div>
            <div class="col-sm-2">
        <button type="submit" class="btn btn-success">บันทึก ฝ่าย</button>
        </div>
    </div>
    </form>

    <form method="POST" action="<?php echo site_url('members/department_add');?>">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">งาน</label>
        <div class="col-sm-4">
          <select class="form-control"  name='rootDepaID'>
          <?php
          $sql2 = "select * from tb_department where statusDepa='2' order by departmentID;"; // ดึงข้อมูลจากตาราง product
          $result2 = $this->db->query($sql2);
          foreach ($result2->result() as $row2) {
              $departmentID = $row2->departmentID;
              $departmentName = $row2->departmentName;
              $rootDepaID = $row2->rootDepaID;

              $sql3 = "select * from tb_department where departmentID='$rootDepaID' and statusDepa=1 order by departmentID;"; // ดึงข้อมูลจากตาราง product
              $result3 = $this->db->query($sql3);
              foreach ($result3->result() as $row3) {
                  $rootDepaName = $row3->departmentName;
                  echo "<option value='" . $departmentID . "' >" . $rootDepaName . " [ " . $departmentName . " ]" . "</option>";
              }
          }
          ?>
          </select>        
        </div>
        <div class="col-sm-4">
        <input type="text" name="DepatName" class="form-control" placeholder="งาน">
        <input type="hidden" name="statusDepa" class="form-control"  value='3'>

        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-warning">บันทึก งาน</button>
        </div>
    </div>
    </form>

	
<a class="btn btn-danger  btn-block" href='<?php echo site_url();?>'>ย้อนกลับ</a>
    



    <table class="table table-hover" >
      <tr  class="table-active">
        <th width='10%'><b>ลำดับ</b></th>
        <th width='70%'><b>กอง / สำนัก</b></th>
        <th width='20%'><b>แก้ไข</b></th>
      </tr>

    <?php
    $num2=0;
    $sql = "select * from tb_department where statusDepa=1 order by departmentID;"; // ดึงข้อมูลจากตาราง product
      $query = $this->db->query($sql);
      foreach ($query->result() as $row) {

        $departmentID = $row->departmentID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $departmentName = $row->departmentName;	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
        $rootDepaID = $row->rootDepaID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $statusDepa = $row->statusDepa;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        ?>
    <tr>
      <td><?php 
            $num2 = $num2 + 1;
            echo $num2;
            ?></td>
      <td><?php 
            echo $departmentName; ?></td>
      <td>
        <a href="<?php echo site_url('members/department_edit/'.$departmentID); ?>">แก้ไข </a>|
        <a href='<?php echo site_url('members/department_del/'.$departmentID); ?>'> ยกเลิก</a>
      </td>
    </tr>
<?php
    } ?>
        <table>



        <table class="table table-hover" ><tr  class="table-active">
          <th width='10%'><b>ลำดับ</b></th>
          <th width='40%'><b>ฝ่าย</b></th>
          <th width='30%'><b>กอง / สำนัก</b></th>
          <th width='20%'><b>แก้ไข</b></th>
        </tr>

    <?php
      $num3=0;
      $sql = "select * from tb_department where statusDepa=2 order by departmentID;"; // ดึงข้อมูลจากตาราง product
      $query = $this->db->query($sql);
      foreach ($query->result() as $row) {     
        $departmentID = $row->departmentID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $departmentName = $row->departmentName;	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
        $rootDepaID = $row->rootDepaID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $statusDepa = $row->statusDepa;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

        ?>
    <tr>
      <td><?php 
            $num3 = $num3 + 1;
            echo $num3;
            ?></td>
      <td><?php echo $departmentName ?></td>
      <td><?php 
            $sql4 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
            
            $result4 = $this->db->query($sql4);
            foreach ($result4->result() as $row4) { 
                $rootDepaName = $row4->departmentName;
            }
            echo $rootDepaName; ?></td>
      <td>
        <a href="<?php echo site_url('members/department_edit/'.$departmentID); ?>">แก้ไข </a>|
        <a href='<?php echo site_url('members/department_del/'.$departmentID); ?>'> ยกเลิก</a>
      </td>
    </tr>

<?php
    } ?>
        <table>
        <table class="table table-hover" ><tr  class="table-active">
          <th width='10%'><b>ลำดับ</b></th>
          <th width='40%'><b>งาน</b></th>
          <th width='30%'><b>กอง/ สำนัก [ฝ่าย ]</b></th>
          <th width='20%'><b>แก้ไข</b></th>
        </tr>

    <?php
    $num4=0;
    $sql = "select * from tb_department where statusDepa=3 order by departmentID;"; // ดึงข้อมูลจากตาราง product
    $result = $this->db->query($sql);
    foreach ($result->result() as $row) { 
        $departmentID = $row->departmentID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $departmentName = $row->departmentName;	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
        $rootDepaID = $row->rootDepaID;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
        $statusDepa = $row->statusDepa;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID

        ?>
    <tr>
      <td><?php 
            $num4 = $num4 + 1;
            echo $num4;
            ?></td>
      <td><?php echo $departmentName ;?></td>
      <td><?php 
            $sql5 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
              $result5 = $this->db->query($sql5);
              foreach ($result5->result() as $row5) { 
                $rootDepaName = $row5->departmentName;
                $rootDepaID = $row5->rootDepaID;
                $sql6 = "select * from tb_department where departmentID='$rootDepaID' order by departmentID;"; // ดึงข้อมูลจากตาราง product
                $result6 = $this->db->query($sql6);
                foreach ($result6->result() as $row6) {
                    $subDepaName = $row6->departmentName;
                }
            }
            echo $subDepaName." [".$rootDepaName."] "; ?></td>
      <td>
        <a href="<?php echo site_url('members/department_edit/'.$departmentID); ?>">แก้ไข </a>|
        <a href='<?php echo site_url('members/department_del/'.$departmentID); ?>'> ยกเลิก</a>
      </center></td>
    </tr>
<?php 
    } 
    ?>
        <table>
    </div>
  </div>
</div>
