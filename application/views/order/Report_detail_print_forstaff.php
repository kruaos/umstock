  <style type="text/css">
    #printable { display: block; }  
    
    @media print   
    {   
         #non-printable { display: none; }   
         #printable { display: block; }   
    }   
  </style>

  

<?php 
function dott($n) {
  for ($i = 1; $i <= $n; $i++) {
     echo " . ";
  }
}
$orderNum=$this->uri->segment(3);
$sql10 = "SELECT * FROM tb_order where orderNum=$orderNum"; 
$result10=$this->db->query($sql10);
foreach ($result10->result()  as $row10) {
  // echo '<pre>';print_r($row10);exit;
       $memberID = $row10->memberID;
       $dayneed=$row10->dayneed;
       $staff1=$row10->staff1;
       $orderIdReport=$row10->orderIdReport;
       $detail=$row10->detail;

      $sql6 = "select * from tb_customer where cusid=$memberID"; 
      $result6 = $this->db->query($sql6);
      foreach ($result6->result()  as $row6) {
          $fullnamecus = $row6->fullname; 
        }
        if($staff1=='0'){
              $fullnameAllow = ". . . . . . . . . . . . . . . . . . . . ";
        }else{
          $sql7 = "select * from tb_customer where cusid=$staff1"; 
          $result7 = $this->db->query($sql7);
          foreach ($result7->result()  as $row7) {
            $fullnameAllow = $row7->fullname; 
          }
       }
}

?>
<div class="container col-10 "  style="font-family: 'Sarabun', sans-serif; font-Size:14pt">
  <div class="row">
        <?php  
        $disable="";
        if($orderIdReport==0){
          $disable="disabled ";
          } 
        ?>   
          <a id="non-printable" class="btn btn-danger btn-sm col " href='<?php echo site_url('order/approval');?>'>ย้อนกลับ</a>
          <a id="non-printable" class="btn btn-info btn-sm col <?php echo $disable; ?>" onClick="window.print()" >พิมพ์</a>
      </div>
<div class="row" style="margin-top:30px">
  <div class="col-12 "style="line-height: 24pt ">
<div class="text-center"><h3>ใบเบิกพัสดุ</h3></div>
ลำดับที่ <?php 
if($orderIdReport==0){
  echo "-รออนุมัติ-";
} else{
  echo $orderIdReport;
}
?><br>
<div class="text-right">ฝ่าย  <?php echo dott(13);?>  กอง  <?php echo dott(13);?> </div><br> 
<table   width='100%'>
      <tr >
        <td  width='60%'></td>
        <td style="font-family: 'Sarabun', sans-serif; font-Size:14pt">วันที่ <?php
        $showmont = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤษจิกายน', 'ธันวาคม');
        $showdate = number_format(substr($dayneed, 8, 2)) . " " . $showmont[number_format(substr($dayneed, 5, 2)) - 1] . " " . (substr($dayneed, 0, 4) + 543);
        echo $showdate;    
        ?></td>
      </tr>
      </table>

เรียน หัวหน้าพัสดุฯ<br>
<table   width='100%'>
      <tr >
        <td style="font-family: 'Sarabun', sans-serif; font-Size:14pt">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ด้วยฝ่าย <?php echo dott(5);?><?=$fullnamecus;?><?php echo dott(5);?> กอง <?php echo dott(20);?> มีความประสงค์ต้องใช้พัสดุเพื่อ
        <?php echo dott(10).$detail;echo dott(10)    ?> ดังมีรายละเอียดดังต่อไปนี้ <br>
</td>
      </tr>
      </table>
  </div>
  <div class="col-12 " >
      <table class='table table-sm border border-dark'  >
        <tr class='text-center border border-dark'>
            <th width='50' class='border border-dark'><b>ลำดับที่</b></th>
            <th width='400'class='border border-dark'><b>รายการ(บอกคุณลักษณะหรือยี่ห้อโดยรายละเอียด) </b></th>
            <th width='70'class='border border-dark'>จำนวน </th>
            <th width='100'class='border border-dark'>คงเหลือหลังเบิก</th>
            <th width='100'class='border border-dark'>หมายเหตุ</th>
        </tr>
<?php
$startout=0;
$sql1 = "SELECT * FROM tb_orderdetail where orderID=$orderNum and statusfile=0"; 
$rs_tb_orderfile = $this->db->query($sql1);
      $nb = $rs_tb_orderfile->num_rows() ;
      foreach ($rs_tb_orderfile->result() as $rs_show_tborderfile) {
        $productID = $rs_show_tborderfile->productID; 
        $amount = $rs_show_tborderfile->amount;

          $sql3 = "select * from tb_product where id=$productID;"; 
          $result3 = $this->db->query($sql3);
          foreach ($result3->result() as $row3) {
            $price = $row3->price;
            $detailBasket = $row3->productName." [ ".$price." บาท "."]" ;
          }
        $sumamout = $rs_show_tborderfile->amount;

  ?>
      <tr style="font-family: 'Sarabun', sans-serif; font-Size:14pt">
        <td class='text-center border border-dark' ><?php echo $startout = $startout + 1; ?></td>
        <td class='text-left border border-dark'><?php echo $detailBasket; ?></td>
        <td class='text-center border border-dark'><?php echo abs($amount); ?> </td>
        <td class='text-center border border-dark'>
          <?php 
              $sql4 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 ";
              $result4 = $this->db->query($sql4);
              foreach ($result4->result() as $row4) {
                echo $row4->sumamo;
              }    
          ?>
        </td>
        <td class='text-right border border-dark'><?php ?></td>
       </tr>
        <?php
      } 
      $y=10-$nb;
      for($x=1;$x<=$y;$x++){
      ?>
      <tr >
        <td class='text-center border border-dark'>&nbsp;</td>
        <td class='text-left border border-dark'></td>
        <td class='text-right border border-dark'> </td>
        <td class='text-right border border-dark'></td>
        <td class='text-right border border-dark'></td>
       </tr>
        <?php
      }
      ?>
      <tr >
        <td class='text-center' ></td>
        <td class='text-center'>รวมเบิก</td>
        <td class='text-right border border-dark'> </td>
        <td class='text-right border border-dark'></td>
        <td class='text-right border border-dark'></td>
      </tr>
      </table>
      <div style="line-height: 24pt ">

พัสดุดังกล่าวต้องการภายในกำหนด <?php echo dott(30);?> วัน <br>
ขอได้โปรดจ่ายพัสดุดังกล่าวให้ภายกำหนดด้วย <br>
&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo dott(30);?>เจ้าหน้าที่กอง<?php echo dott(30);?><br>
&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php echo dott(30);?>หัวหน้าน่วยงาน<?php echo dott(30);?><br>
ความเห็นของเจ้าหน้าที่พัสดุ <?php echo dott(150);?><br>
<table  width='100%'>
      <tr >
        <td width='35%'></td>
        <td  style="font-family: 'Sarabun', sans-serif; font-Size:14pt"><br><?php echo dott(22);?>เจ้าหน้าที่พัสดุ<br>

        (<?php echo $fullnameAllow;?>)  </td> 
      </tr>
      </table>

[ &nbsp;&nbsp; ] &nbsp;&nbsp;จ่ายพัสดุให้ตามที่ขอ <br>
[ &nbsp;&nbsp; ] &nbsp;&nbsp;ทำรายการเสนอสั่งซื้อ<br>
<table   width='100%'>
      <tr >
        <td  width='35%'></td>
        <td  style="font-family: 'Sarabun', sans-serif; font-Size:14pt"><br><?php echo dott(22);?> หัวหน้าสำนักปลัด/ผู้อำนวยการกอง<br>(<?php echo dott(20);?>)  </td> 
      </tr>
      </table>
ได้รับพัสดุตามที่ขอเบิกถูกต้องแล้ว<br>
<table   width='100%'>
      <tr >
        <td  width='35%'></td>
        <td  style="font-family: 'Sarabun', sans-serif; font-Size:14pt"><br><?php echo dott(22);?>ผู้ขอเบิก<br>(<?php echo $fullnamecus;?>)<br>
<?php echo dott(7);?>/<?php echo dott(7);?>/<?php echo dott(7);?><br><br></td> 
      </tr>
      </table>
</div>
</div>
</div>
</div>
