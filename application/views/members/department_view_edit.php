
<div class="container" style="margin-top:70px">
  <div class="row">
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
<?PHP  
$departmentID=$this->uri->segment(3);
$sql="select * from tb_department where departmentID=$departmentID";
$query=$this->db->query($sql);
foreach ($query->result() as $rskey) {
   $key_select=$rskey->rootDepaID;
   $departmentName_edit=$rskey->departmentName;
   $departmentID_edit=$rskey->departmentID;


}

if($key_select==0)
{

?>
    <div class="col-md-12">
        <h4>แก้ไข สำนัก/กอง</h4>
        <form method="POST" action="<?php echo site_url('members/department_update');?>">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">สำนัก/กอง</label>
              <div class="col">
              <input type="text" name="departmentName_edit" class="form-control" value="<?php echo $departmentName_edit; ?>">
              <input type="hidden" name="departmentID_edit" value="<?php echo $departmentID_edit;?> ">
              </div>
                <div class="col-sm-3">
            <button type="submit" class="btn btn-success">บันทึกการแก้ไข</button>
            </div>
        </div>
        </form>
    </div>
<?php
} elseif($key_select==1){
?>
    <div class="col-md-12">
        <h4>แก้ไข ฝ่าย</h4>

        <form method="POST" action="<?php echo site_url('members/department_update');?>">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">ฝ่าย</label>
            <div class="col">
            <input type="text" name="departmentName_edit" class="form-control" value="<?php echo $departmentName_edit; ?>">
            <input type="hidden" name="departmentID_edit" value="<?php echo $departmentID_edit;?> ">
            </div>
                <div class="col-sm-3">
            <button type="submit" class="btn btn-success">บันทึกการแก้ไข</button>
            </div>
        </div>
        </form>
    </div>
<?php
} elseif($key_select==2){
?>
    <div class="col-md-12">
        <h4>แก้ไข งาน</h4>


      <form method="POST" action="<?php echo site_url('members/department_update');?>">
      <div class="form-group row">
          <label class="col-sm-2 col-form-label">งาน</label>
          <div class="col">
          <input type="text" name="departmentName_edit" class="form-control" value="<?php echo $departmentName_edit; ?>">
          <input type="hidden" name="departmentID_edit" value="<?php echo $departmentID_edit;?> ">
          </div>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-success">บันทึกการแก้ไข</button>
          </div>
      </div>
      </form>
    </div>
<?php 
} 
?>

<a class="btn btn-danger  btn-block" href='<?php echo site_url('members/department/'); ?>'>ย้อนกลับ</a>
  </div>
</div>
