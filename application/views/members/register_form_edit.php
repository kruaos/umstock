<?php
date_default_timezone_set("Asia/Bangkok");
foreach ($show_member_and_customer as $rs_member)
  $username=$rs_member->username;
  $fullname=$rs_member->fullname;
  $diveision=$rs_member->diveision;
  //print_r($rs_member) ;
?>
<div class="container col-10 " >
  <div class="row" style="margin-top:70px">
    <div class="alert alert-primary col-12" role="alert">
    แก้ไขบันทึกข้อมูล :: Edit Member ::

    </div>
      <form class="form-group col " method="POST" action="<?php echo site_url(''); ?>">
        
        <div class="form-group row ">
          <label class="col-md-3 col-form-label  ">Username </label>
          <input type="text" name="Username " class="form-control col" value="<?php echo $username;?>" placeholder="Username " disabled>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label ">ชื่อ - สกุล</label>
          <input type="text" name="member_fullname" class="form-control col" value="<?php echo $fullname;?>" placeholder="ชื่อ - สกุล" disabled >
        </div>
        <div class="form-group row">
          <label class="col-md-3 col-form-label ">ตำแหน่ง</label>
          <input type="text" name="diveision" class="form-control col" value="<?php echo $rs_member->diveision;?>" placeholder="ตำแหน่ง" disabled >
        </div>

        <div class="form-group row " >
          <label class="col-md-3 col-form-label  "  name="department_name" >สำนัก/ กอง </label>
          <select class="custom-select  col disabled" >
            <?php 
                $department_from_tb_member=$rs_member->department;
                foreach ($show_department_all as $rs_department)
                {
                   $departmentID=$rs_department->departmentID;
                   $departmentName=$rs_department->departmentName;
            ?>
             <option value="<?php echo $departmentID; ?>" <?php if($departmentID==$department_from_tb_member){echo 'selected';}?> >
              <?php echo $departmentName;?> </option>
            <?php 
                }
            ?>
          </select>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label ">สมัครเมื่อ</label>
          <input type="text" name="reg_date" class="form-control col disabled" value="<?php echo $rs_member->reg_date;?>"  placeholder="สมัครเมื่อ" disabled >
        </div>

   
        <div class="form-group row">
          <a href="<?php echo site_url('');?>" class="btn btn-danger col-6">ยกเลิก</a>
          <button type="submit" class="btn btn-success col-6">บันทึก</button>
        </div>
      </form>

  </div>
</div>

 