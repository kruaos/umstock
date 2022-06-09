   
<div class="container">

  <H1>:: ลงทะเบียนเข้าใช้ระบบ ::</H1>
  <form method="POST"  action="register_addmember" >
    <div class="form-group row">
      <label  class="col-sm-2 col-form-label">ชื่อเข้าใช้ </label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="Username" placeholder="Username">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="Password" placeholder="Password">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ชื่อ - สกุล</label>
      <div class="col-sm-10">
        <select class="form-control" name='name_reg'>
          <?php
            foreach ($show_customer_online as $row ) {
              $customerName = $row->fullname;
              $cusid = $row->cusid;
              echo "<option value='" . $cusid . "'> [" . $cusid . '] ' . $customerName . "</option>";
            }
          ?>
        </select>    
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">กอง</label>
      <div class="col-sm-10">
        <select class="form-control" name='depa_reg'>
          <?php
            foreach ($show_department_all as $row1 ) {
              $departmentID = $row1->departmentID;
              $departmentName = $row1->departmentName;
              echo "<option value='" . $departmentID . "' >" . $departmentName . "</option>";
          }
          ?>
        </select>    
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-success  btn-sm" >ลงทะเบียน</button>
        <button class="btn btn-danger  btn-sm"  TYPE="Reset" >ยกเลิก</button>
        <a class="btn btn-info  btn-sm"  href='<?php echo site_url(''); ?>'>ย้อนกลับ</a>
      </div>
    </div>
  </form>
</div>