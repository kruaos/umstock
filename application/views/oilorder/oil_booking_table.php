<?php 

?>
<div class="container">
  <div class="row ">
  <div class="col-12 ">
  <table class="table table-hover small table-sm">
    <thead>
      <tr>
        <th width='100' rowspan="2" class='text-center'>วัน เดือน ปี</th>
        <th width='300' rowspan="2" class='text-center'>รับจาก /จ่ายให้ </th>
        <th width='200' rowspan="2" class='text-center'>เลขที่เอกสาร </th>
        <th width='200' rowspan="2" class='text-center'>ราคาต่อหน่วย (บาท)</th>
        <th width='200' colspan="2" class='text-center'>รับ </th>
        <th width='200' colspan="2" class='text-center'>จ่าย </th>
        <th width='200' colspan="2" class='text-center'>คงเหลือ </th>
        <th width='100' rowspan="2" class='text-center'>หมายเหตุ </th>
      </tr>
      <tr>
        <th width='100'>จำนวน </th>
        <th width='100'>บาท </th>
        <th width='100'>จำนวน </th>
        <th width='100'>บาท </th>
        <th width='100'>จำนวน </th>
        <th width='100'>บาท </th>
      </tr>

    </thead>
    <tbody>
<?php 



$num=1;

foreach ($show_oilorder as $row) {
  $oil_order_id= $row->oil_order_id;
  $oil_order_number= $row->oil_order_number;
  $oil_order_customerID= $row->oil_order_customerID;
  $oil_order_car_member_number= $row->oil_order_car_member_number;
  $oil_order_oil_type= $row->oil_order_oil_type;
  $oil_order_quantity= $row->oil_order_quantity;
  $oil_order_createdate= $row->oil_order_createdate;

?>
      <tr>
      <td>
        <?php echo $this->showdatetime_thai->show_day($oil_order_createdate); ?>
      </td>
      <td>
        <?php 
          $sql2 = "select * from tb_customer where cusid=$oil_order_customerID"; 
          $result2 = $this->db->query($sql2);
          foreach ($result2->result() as $row2) {
            echo   $fullname = $row2->fullname; 
          }
        ?>      
      </td>
      <td>
          <?php 
          $sql2 = "select * from tb_customer where cusid=$car_order_allow1"; 
          $result2 = $this->db->query($sql2);
          foreach ($result2->result() as $row2) {
            echo   $fullname = $row2->fullname; 
          }
        ?> 
      </td>
      <td>
        <?php echo $oil_order_number; ?>
      </td>
      <td>
        <?php echo $car_order_detail; ?>
      </td>
      <td>
        <?php echo $car_order_seat; ?>
      </td>
      <td><?php 
              echo $this->showdatetime_thai->show_day($car_order_timeuse);      
          ?>
      </td>
      <td><?php 
              echo $this->showdatetime_thai->show_day($car_order_timeback);      
          ?>
      </td>
      <td>
        <?php 
          if ($car_order_allow2==0){
            echo "รอลงนาม";
          }
          $sql2 = "select fullname from tb_customer where cusid=$car_order_allow2"; 
          $result2 = $this->db->query($sql2);
            foreach ($result2->result() as $row2) {
              echo   $fullname = $row2->fullname; 
          }
        ?> 
      </td>
      </tr>
<?php 
}

?>
    </tbody>
  </table>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>

  </div>
  </div>
 </div>
