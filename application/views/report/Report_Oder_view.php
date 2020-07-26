<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
$sess_memberid=$this->session->userdata('userid');
$fullname=$this->session->userdata('fullname');
?>
<div class="container " >
  <div class="row" >
    <div class="col-12 ">
    <h5>ข้อมูลการขอเบิกพัสดุ ของ <?php echo $fullname;?></h5>
    </div>
  </div>
  <div class="row" >
  <div class="col">
  <table class="table  table-hover table-sm">
    <thead>
    <tr>
        <th width='100'>ลำดับที่</th>
        <th width='100'>ใบเบิกที่</th>
        <th width='300'>ชื่อผู้เบิก</th>
        <th width='150'>วันที่เบิก</th>
        <th width='150'>วันที่ต้องการ</th>
        <th width='100' class='text-center'>สถานะ</th>
        <th width='200' class='text-center'>หมายเหตุ</th>
      </tr>
    </thead>
    <tbody>
<?php 
$num=0;
$sql = "select * from tb_order where memberID=$sess_memberid and status<>0 "; 
$rs = $this->db->query($sql);
foreach ($rs->result() as $row) {
  $memberID = $row->memberID; 
  $orderNum = $row->orderNum; 
  $dayneed = $row->dayneed; 
  $detail = $row->detail; 
  $staff1 = $row->staff1; 
  $createdate = $row->createdate; 
  $orderID = $row->orderID; 
  $orderIdReport = $row->orderIdReport; 

?>
      <tr>
      <td><?php echo $num=$num+1;?></td>
      <td><?php 
        if($orderIdReport==0){
          echo "-";
          $unclick=" ";
        } else{
          echo $orderIdReport;
          $unclick="disabled";
        }   
        ?>
        </td>        <td><?=$fullname;?></td>
        <td><?php 
              $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
              $showdate = number_format(substr($createdate, 8, 2)) . " " . $showmont[number_format(substr($createdate, 5, 2))] . " " . (substr($createdate, 2, 2) + 43);
              echo $showdate;      
          ?></td>
        <td><?php 
              $dayneed = number_format(substr($dayneed, 8, 2)) . " " . $showmont[number_format(substr($dayneed, 5, 2))] . " " . (substr( $dayneed, 2, 2) + 43);
              echo $dayneed;      
          ?></td>
        <?php 
        if($staff1==0){
          echo "<td class='table-danger text-center'>รออนุมัติ</td>" ;
        }else{
          echo "<td class='table-success text-center'>อนุมัติแล้ว</td>" ;
        }
        ?>
        <td class='text-center'>
          <div class="btn-group col-md-12" role="group" aria-label="Basic example">
            <a class="col-md-6 btn btn-primary btn-sm" href="<?php echo site_url('report/printorderDetial/'.$orderNum);?>"><div class='small'>รายละเอียด</div></a>
            <a class="col-md-6 btn btn-danger  btn-sm <?php echo $unclick;?> " href="<?php echo site_url('report/printorderdel/'.$orderID);?>"><div class='small'>ยกเลิก</div></a>
          </div>
        </td>
      </tr>
<?php 
}
?>
    </tbody>
  </table>
  </div>
  </div>
 </div>
   </div>
  </div>
 </div>