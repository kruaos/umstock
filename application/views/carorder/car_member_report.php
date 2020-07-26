<?php 

?>

<div class="container">
  <div class="p-2 bg-secondary text-white rounded">
  ตารางข้อมูล คุรุภัณฑ์รถยนต์
  </div>
  <div class="row ">
  <div class="col-12 ">
  <table class="table table-hover small table-sm">
    <thead>
      <tr>
        <th width='100'>ยี่ห้อ</th>
        <th width='200'>เลขทะเบียน </th>
        <th width='100'>แรงม้า</th>
        <th width='100'>จำนวนลูกสูบ</th>
        <th width='200'>ผู้รับผิดชอบและรักษารถยนต์</th>
        <th width='200'>วันได้มาซึ่งกรรมสิทธิ์</th>
        <th width='150'>กำหนดปริมาณ<br>น้ำมัน 1ลิตร/กม.</th>
        <th >หมายเหตุ</th>
      </tr>
    </thead>
    <tbody>
<?php 



$num=1;
foreach ($car_member as $row) {
  $car_member_id= $row->car_member_id;
  $car_member_display= $row->car_member_display;
  $car_member_brand= $row->car_member_brand;
  $car_member_power= $row->car_member_power;
  $car_member_piston= $row->car_member_piston;
  $car_member_cusID= $row->car_member_cusID;
  $car_member_date_ownership= $row->car_member_date_ownership;
  $car_member_oil_use= $row->car_member_oil_use;

?>
      <tr>
        <td>
          <?php echo $car_member_brand; ?>
        </td>
        <td>
          <?php echo $car_member_display; ?>
        </td>
        <td>
          <?php echo $car_member_power; ?>
        </td>
        <td>
          <?php echo $car_member_piston; ?>
        </td>
        <td>
          <?php 
            $sql2 = "select * from tb_customer where cusid=$car_member_cusID"; 
            $result2 = $this->db->query($sql2);
            foreach ($result2->result() as $row2) {
              echo   $fullname = $row2->fullname; 
            }
          ?>      
        </td>
        <td>
          <?php echo $this->showdatetime_thai->show_day($car_member_date_ownership); ?>
        </td>
        <td>
          <?php echo $car_member_oil_use." ลิตร"; ?>
        </td>
        <td>
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
