<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
$sess_memberid=$this->session->userdata('userid');
$fullname=$this->session->userdata('fullname');


?>
<div class="container" >
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
        </td>        
        <td><?=$fullname;?></td>
        <td><?php 
               echo $this->load->showdatetime_thai->show_day($createdate);
          ?></td>
        <td><?php 
               echo $this->load->showdatetime_thai->show_day($dayneed);
          ?></td>
        <?php 
        if($staff1==0){
          echo "<td class='table-danger text-center'>รออนุมัติ</td>" ;
        }else{
          echo "<td class='table-success text-center'>อนุมัติแล้ว</td>" ;
        }
        ?>

        </tr>
        <?php 
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
