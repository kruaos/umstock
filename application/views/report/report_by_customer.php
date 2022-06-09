
<div class="container" style="margin-top:30px">
  <div class="row">
  <div class="col-md-12">
           
  <h1>รายงานพัสดุ จำแนกบุคคล</h1>     
    <table width='100%' class="table table-hover table-sm small"><tr class='text-center'>
          <th width='5%'><b>ลำดับ</b></th>
          <th width='20%'><b>บุคลากร</b></th>
          <th width='10%'><b>จำนวนเงินเบิก</b></th>
          <th width='10%'><b>..</b></th>
          <th width='10%'><b>แผนงานที่เกี่ยวข้อง</b></th>
          <th width='10%'><b>หมายเหตุ</b></th>
      </tr>
    
 <?php
 $num =0;$suminall=0;$sumoutall=0;
  $sql = "select * from tb_customer where status='1' order by cusid ;"; 
  foreach ($this->db->query($sql)->result() as $row) {
      $cusid = $row->cusid;	 
            
      $sql8 = "select SUM(a.amount*b.price)as'sumin' 
      from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
      where a.statusfile='0' and a.cusid=$cusid and a.statusfile=0";
      foreach ($this->db->query($sql8)->result() as $row8) 

      if(abs($row8->sumin)>=1){
        $sql1 = "select * from tb_customer where cusid=$cusid"; 
        foreach ($this->db->query($sql1)->result() as $row1) {
          $fullname = $row1->fullname;	 

?>
    <tr class='text-center <?php echo $showdanger; ?>'>
        <td ><?php $num = $num + 1;  echo $num;?></td>
        <td class="text-left" >
          <a href="<?php echo site_url('report/ReportDetailCus/'.$cusid);?>"><?php echo $fullname ;?></a>
        </td>
          <td class='text-right'>
          <?php 
          echo  $sumin = number_format(abs($row8->sumin));
          ?>          
          </td>
          <td class='text-right'>..</td>
          <td>..</td>
          <td class='text-right'>..</td>
    </tr>
<?php 
        }
    }
   } ?>
      <tr class='text-center'>
            <td ></td>
            <td >รวม</td>
            <td ></td>
            <td  class='text-right'><?= number_format($suminall);?></td>
            <td  class='text-right'><?= number_format(abs($sumoutall));?></td>
            <td ></td>
            <td  class='text-right'><?= number_format($suminall+$sumoutall);?></td>
          </tr>
        </table>
   
   <a href="<?php echo site_url('');?>" id="non-printable" class="btn btn-danger  col-md">ย้อนกลับ</a>

    </div>
  </div>
  </div>
