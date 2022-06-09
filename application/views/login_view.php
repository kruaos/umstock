<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container " style="margin-top:70px">
    <div class="text-center">
    <img src="<?php echo base_url('/picture/informe.png');?>" class="rounded" width='100'>
    <h1 >ระบบบริหารพัสดุสำนักงานเทศบาลตำบลอุโมงค์</h1>
  </div>
  <div class="card col-6 card-login mx-auto mt-3">
      <div class="card-body">
                <FORM   id="form_id" METHOD="POST" ACTION="<?php echo site_url('/home/login');?>" >
          <div class="form-group">
            <div class="form-label-group">
              <label>ชื่อเข้าใช้ :</label>
                  <INPUT TYPE="text" class="form-control" placeholder="ลงชื่อผู้ใช้"  name="user_login" id="username">  </INPUT>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
                <label >รหัสผ่าน : </label>
                <input type="password" class="form-control "  placeholder="กรอกรหัสผ่าน" name="pass_login"  id="password" >
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block " >เข้าสู่ระบบ </button>
          <a href="<?php echo site_url('members/register'); ?>" class="btn btn-danger btn-block  " >ลงทะเบียน</a>
        </form>
      </div>
    </div>
  </div>


       