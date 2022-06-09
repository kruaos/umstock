<?php 
  function show_day($createdate){
         $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
         $showdate = number_format(substr($createdate, 8, 2)) . " " . $showmont[number_format(substr($createdate, 5, 2)) - 1] . " " . (substr($createdate, 2, 2) + 43);
        return  $showdate;
  }

?>
<div class="container" style="margin-top:70px" >
  <div class="row" >
    <div class="col-12 ">
  <h3>เมนูการอนุมัติพัสดุ</h3>
    </div>
  <div class="col ">
  <table class="table  table-hover small table-sm">
    <thead>
      <tr>
        <th width='50'>ลำดับที่</th>
        <th width='50'>ใบเบิกที่</th>
        <th width='200'>ชื่อผู้เบิก</th>
        <th width='100'>วันที่เบิก</th>
        <th width='100'>วันที่ต้องการ</th>
        <th width='100' class='text-center'>สถานะ</th>
        <th width='300'class='text-center'>หมายเหตุ</th>
      </tr>
    </thead>
    <tbody>
<?php 
$num=1;
$sql = "SELECT * from tb_order where status='1' ORDER BY `tb_order`.`orderID` DESC
"; 
$result = $this->db->query($sql);
foreach ($result->result() as $row) {
  $memberID = $row->memberID; 
  $orderNum = $row->orderNum; 
  $dayneed = $row->dayneed; 
  $detail = $row->detail; 
  $staff1 = $row->staff1; 
  $createdate = $row->createdate; 
  $orderID = $row->orderID; 
  $orderIdReport = $row->orderIdReport; 

  $disable="";
  if($staff1<>0){
    $disable="disabled";
  }

?>
      <tr>
      <td><?php echo $num; $num=$num+1;?></td>
        <td><?php 
        if($orderIdReport==0){
          echo "-";
        } else{
          echo $orderIdReport;
        }   
        ?>
        </td>
        <td>
        <?php 
$sql2 = "select * from tb_customer where cusid=$memberID "; 
$result2 = $this->db->query($sql2);
foreach ($result2->result() as $row2) {
  echo   $fullname = $row2->fullname; 
}
?>     
        </td>
        <td><?php 
              echo show_day($createdate);      
          ?></td>
        <td><?php 

              echo show_day($dayneed);      
          ?></td>
        <?php 
        if($staff1==0){
          echo "<td class='table-danger text-center'>รออนุมัติ</td>" ;
        }else{
          echo "<td class='table-success text-center'>อนุมัติแล้ว</td>" ;
        }
        ?>
        <td class='text-center'>
        <div class="col btn-group  btn-group-toggle" >
          <a class="col btn btn-primary btn-sm" href="<?php echo site_url('order/orderdetailapproval/'.$orderNum);?>">รายละเอียด</a>
          <a class="col btn btn-info  btn-sm <?php echo $disable;?>" href="<?php echo site_url('order/approvalable/'.$orderID);?>">อนุมัติ</a>
          <?php 
          $sess_authority=$this->session->userdata('authority');
          $sess_memberid=$this->session->userdata('userid');
          if($sess_memberid=='43'or $sess_authority=='m'){
          ?>
          <a class="col btn btn-danger  btn-sm" href='<?php echo site_url('order/unapproval/'.$orderID);?>'>ยกเลิก</a>
        </div>
        <?php 
          }
        ?>

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
