<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-xs-1"></div>
    <div class="col-sm-12 col-md-12 col-xs-12">
    <h1>เพิ่มข้อมูลสมาชิก</h1>

<form method='post' action="<?PHP echo site_url('members/member_add');?>">

  <div class="form-row">
    <div class="form-group col-md-4 ">
        <label >ชื่อ-สกุล</label>
        <input type="text" class="form-control" name='fullname' class="form-control" >
    </div>    
    <div class="form-group col-md-4 ">
        <label >ตำแหน่ง</label>
        <input type="text" class="form-control" name='diveision' class="form-control" >
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
        $sql2 = "select * from tb_department where statusDepa<>0 and rootDepaID=0  order by departmentName;"; // ดึงข้อมูลจากตาราง product
        $result2=$this->db->query($sql2);
        foreach ($result2->result() as $row2) {
            $departmentID = $row2->departmentID;
            $departmentName = $row2->departmentName;
            $rootDepaID = $row2->rootDepaID;
                echo "<option value='" . $departmentID . "'". $chkk." >"  . $departmentName ."</option>";
                }
        ?>
        </select>  </div>
  </div>
  <div class="form-row ">
    <a href="<?PHP echo site_url('');?>" class="btn btn-danger col">ยกเลิก</a>
    <button type="submit" class="btn btn-warning col">บันทึกรายการ</button>
  </div>
</form>
 
    <table  class="table table-hover  small table-sm  " style="margin-top:30px">
    <tr class='text-center'>
          <th width='100' class='text-center'>ที่ </th>
          <th width='300'>ชื่อ-สกุล</th>
          <th width='300'>ตำแหน่ง</th>
          <th width='300'>สังกัด</th>
          <th width='200'>แก้ไข</th>
    </tr>
        <?php


        $sql = "select * from tb_customer where status='1' order by  department asc "; // ดึงข้อมูลจากตาราง product
        $result=$this->db->query($sql);
        foreach ($result->result() as $row) {  
           $cusid=$row->cusid;
      ?>
    <tr>
      <td class='text-center'><?php  echo $num=$num+1;?></td>
      <td><?php  echo $row->fullname;  ?></td>
      <td><?php  echo $row->diveision;?></td>
      <td><?php  
                $departmentID=$row->department;
                $sql3 = "select * from tb_department  where statusDepa<>0 and rootDepaID=0  and departmentID=$departmentID"; // ดึงข้อมูลจากตาราง product

                $result3=$this->db->query($sql3);
                foreach ($result3->result() as $row3) {  

                  $departmentName = $row3->departmentName;
                  if ($departmentID==$row3->departmentID){
                    echo $departmentName;
                  }
                }
      ?></td>
      <td style="text-align:center;" >
        <a class="btn btn-primary btn-sm" href="<?php echo site_url('members/member_edit/'.$cusid);?>">แก้ไข</a>
        <a class="btn btn-danger btn-sm" href="<?php echo site_url('members/member_del/'.$cusid);?>">ลบ</a>
      </td>
    </tr>  
<?php
    } ?>
        </table>
    </div>
  </div>
</div>

