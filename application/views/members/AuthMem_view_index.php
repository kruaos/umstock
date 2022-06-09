<?
date_default_timezone_set("Asia/Bangkok");
?>
<div class="container col-12 " >
  <div class="row" style="margin-top:70px">
    <div class="col-12 ">
      <h3>กำหนดสิทธิผู้ใช้บริการ<h3>
    </div>
  <div class="col ">
  <table class="table  table-hover  table-sm">
    <thead>
      <tr>
        <th >ลำดับที่</th>
        <th >ชื่อผู้ใช้</th>
        <th width='10%'>วันที่สมัคร</th>
        <th width='10%'>สถานะ</th>
        <th width='50%'>กำหนด</th>
      </tr>
    </thead>
<?php 
/*
  $query = $this->db->query($sql);
  foreach ($query->result() as $row) {
*/

$num=1;
$sql = "select * from tb_member where authority<>'a' and memberID<>1 "; 
  $query = $this->db->query($sql);
  foreach ($query->result() as $row) {
  $memberID = $row->memberID; 
  $createdate = $row->reg_date; 
  $cusid = $row->name; 
  $authority = $row->authority; 

        $sql1 = "select * from tb_customer where cusid=$cusid"; 
        $query1 = $this->db->query($sql1);
        foreach ($query1->result() as $row1) {
          $fullname = $row1->fullname;	 
        }
?>
      <tr>
      <td><?php echo $num; $num=$num+1;?></td>
        <td><?php echo $fullname;?></td>
        <td><?php 
              $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
              $showdate = number_format(substr($createdate, 8, 2)) . " " . $showmont[number_format(substr($createdate, 5, 2)) - 1] . " " . (substr($createdate, 2, 2) + 43);
              echo $showdate;      
          ?></td>
        <td><?php 
        if($authority=='w'){
          echo " <div class=' text-danger' > รออนุมัติ </div>" ;
        }else if($authority=='s'){
          echo "<div class=' text-success' > ผู้ดูแลระบบ</div>" ;
        }else if($authority=='u'){
          echo "<div class=' text-secondary ' > ผู้ใช้ทั่วไป</div>" ;
        }else if($authority=='m'){
          echo "<div class=' text-warning ' > ผู้บริหาร</div>" ;
        }else if($authority=='o'){
          echo "ยกเลิก" ;
          }
        ?></td>
        <td align="center"  >
          <a class="btn btn-warning col-3  btn-sm " href="<?php echo site_url('members/AuthMemSet/m/'.$memberID);?>">ผู้บริหาร</a>
          <a class="btn btn-success col-3  btn-sm" href="<?php echo site_url('members/AuthMemSet/s/'.$memberID);?>">ผู้ดูแลระบบ</a>
          <a class="btn btn-secondary col-3  btn-sm" href="<?php echo site_url('members/AuthMemSet/u/'.$memberID);?>">ผู้ใช้ทั่วไป</a>
          <a class="btn btn-danger  col-2  btn-sm" href="<?php echo site_url('members/AuthMemSet/o/'.$memberID);?>">ยกเลิก</a>
        </td>
      </tr>
<?php 
}
?>
      </table>
    </div>
  </div>
</div>

 