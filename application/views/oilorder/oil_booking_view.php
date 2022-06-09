<?php 

?>
<div class="container">
  <div class="row ">
  <div class="col-12 ">
  <table class="table table-hover small table-sm">
    <thead>
      <tr>
        <th width='100' class='text-center'>วัน เดือน ปี</th>
        <th width='100' class='text-center'>เลขที่ </th>
        <th width='200' class='text-center'>ผู้ขอเบิก</th>
        <th width='200' class='text-center'>ใช้กับรถเลขทะเบียน</th>
        <th width='200' class='text-center'>ชนิดเชื้อเพลิง </th>
        <th width='100' class='text-center'>จำนวน </th>
        <th width='100' class='text-center'>ระยะไมค์ </th>
        <th width='100' class='text-center'>ขอเบิกล่าสุด  </th>
        <th width='300' class='text-center'>หมายเหตุ </th>
        <th width='100' class='text-center'>ดำเนินการ </th>
      </tr>
    </thead>
    <tbody>
<?php 



$num=1;

foreach ($show_oilorder as $row) {
  $oil_order_id= $row->oil_order_id;
  $oil_order_number= $row->oil_order_number;
  $oil_order_customerID= $row->oil_order_customerID;
  $car_member_display= $row->car_member_display;
  $oil_order_oil_type= $row->oil_order_oil_type;
  $oil_order_quantity= $row->oil_order_quantity;
  $oil_order_createdate= $row->oil_order_createdate;
  $oil_order_mile= $row->oil_order_mile;
  $oil_order_lasttimeorder= $row->oil_order_lasttimeorder;
  $oil_order_manager2_approve= $row->oil_order_manager2_approve;
?>
    <tr>
      <td>
        <?php echo $this->showdatetime_thai->show_day($oil_order_createdate); ?>
      </td>
      <td>
        <?php echo $oil_order_number; ?>
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
        <?php echo $car_member_display; ?>
      </td>
      <td>
        <?php echo $oil_order_oil_type; ?>
      </td>
      <td>
        <?php echo $oil_order_quantity; ?>
      </td>
      <td>
        <?php echo $oil_order_mile; ?>
      </td>
      <td>
        <?php 
              echo $this->showdatetime_thai->show_day($oil_order_lasttimeorder);      
        ?>
      </td>
      <td>
        <?php 
          if ($oil_order_manager2_approve==0){
            echo "รอลงนาม";
          }
          $sql2 = "select fullname from tb_customer where cusid=$oil_order_manager2_approve"; 
          $result2 = $this->db->query($sql2);
            foreach ($result2->result() as $row2) {
              echo   $fullname = $row2->fullname; 
          }
        ?> 
      </td>
      <td>
        <a href="<?php echo site_url('/oilorder/oilbookingcancel/').$oil_order_id;?>" class="btn btn-danger btn-sm <?php if ($oil_order_manager2_approve<>0 ){ echo "disabled"; }?>">ลบ</a>  
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
