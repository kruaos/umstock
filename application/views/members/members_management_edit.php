<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12">
    <h1>เพิ่มข้อมูลสมาชิก</h1>
<?php 
// print_r($member);
foreach ($member as $mb) {
  $fullname=$mb->fullname;
  $diveision=$mb->diveision;
  $department=$mb->department;
  $cusid=$mb->cusid;
}

?>


<form method='post' action="<?PHP echo site_url('members/member_update');?>">

  <div class="form-row">
    <div class="form-group col-md-4 ">
        <label >ชื่อ-สกุล</label>
        <input type="text" class="form-control" name='fullname' value="<?php echo $fullname; ?>" >
    </div>    
    <div class="form-group col-md-4 ">
        <label >ตำแหน่ง</label>
        <input type="text" class="form-control" name='diveision' value="<?php echo $diveision; ?>" >
   </div>    
    <div class="form-group col-md-4 ">
        <label >สังกัด</label>
        <select class="form-control"  name='departmentID'>
        <?php
/*
  $query=$this->db->query($sql);
  foreach ($query->result() as $row) {
*/
$num=0;
        $sql2 = "select * from tb_department where statusDepa<>0 and rootDepaID=0  order by departmentID;"; // ดึงข้อมูลจากตาราง product
        $result2=$this->db->query($sql2);
        foreach ($result2->result() as $row2) {
          // echo $department; print_r($row2);exit;
            $departmentID = $row2->departmentID;
            $departmentName = $row2->departmentName;
            $rootDepaID = $row2->rootDepaID;
            if ($departmentID==$department){$chk='selected';}else{$chk='';}
                echo "<option value='" . $departmentID . "'". $chk." >"  . $departmentName ."</option>";
                }
        ?>
        </select>  </div>
        <input type="hidden" name="cusid" value="<?php echo $cusid; ?>">
    </div>
      <div class="form-row ">
        <a href="<?PHP echo site_url('members/management/');?>" class="btn btn-danger col">ยกเลิก</a>
        <button type="submit" class="btn btn-warning col">บันทึกรายการ</button>
      </div>
      </form>
    </div>
  </div>
</div>
