<div class="container col" style="margin-top:70px" >
  <div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12" style="font-family: 'Sarabun', sans-serif; font-Size:12pt">

  <?php
      $YearAccount=$this->uri->segment(4);
      $YearStartAccount=1957+$YearAccount-1;
      $YearEndAccount=1957+$YearAccount;

      $productid=$this->uri->segment(3);
  
function show_day($createdate){
  $showmont=array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
  $showdate=number_format(substr($createdate,8,2))." ".$showmont[number_format(substr($createdate,5,2))-1]." ".(substr($createdate,2,2)+43); 
   return $showdate;
}
$amushow=0;$sumamushow=0;$sumtotalshow=0;$showinc=0;$showout=0;
// echo"<pre>";print_r($product_detil_orderfile);echo "</pre>";
foreach ($product_detil_orderfile as $rspro){
  $createdate=$rspro->createdate;
  $productName=$rspro->productName;
  $categoryID=$rspro->categoryID;
  $amount=$rspro->amount;
  $price=$rspro->price;
  $productID=$rspro->productID;
  $cusid=$rspro->cusid;
  $sellerID=$rspro->sellerID;
  $cusid=$rspro->cusid;
  $statusOrder=$rspro->statusOrder;
  $detail=$rspro->detail;
  $NumProductID=$rspro->NumProductID;
  $productprice=$rspro->price;

}

?>

    <h3  class='text-center'>บัญชีพัสดุ<br> </h3><h4  class='text-center'> <b>ประเภท : </b>
    <?php echo $productName;?> </h4>
    <table width='100%' class="table table-hover table-sm table-bordered" boder='1'>
    
    <tr class='text-center '>
          <th width='10%'class='text-center 'rowspan="2">วันที่ </th>
          <th width='15%'rowspan="2">รายการ</th>
          <th width='25%'colspan="4">รับ</th>
          <th width='25%'colspan="4">จ่าย</th>
          <th width='25%'colspan="2">คงเหลือ</th>

    </tr>
    <tr class='text-center '>          
          <th width='5%'><p class="small">ใบรับที่</th>
          <th width='5%'><p class="small">จำนวน</th>
          <th width='7%'><p class="small">ราคาต่อหน่วย<p></th>
          <th width='5%'><p class="small">เงิน</th>

          <th width='5%'><p class="small">ใบสั่งที่</th>
          <th width='5%'><p class="small">จำนวน</th>
          <th width='7%'><p class="small">ราคาต่อหน่วย<p></th>
          <th width='5%'><p class="small">เงิน</th>
          <th width='5%'><p class="small">จำนวน</th>
          <th width='5%'><p class="small">เงิน</th>
        </tr>
<?php 
          $YearStartAccount_LastAcc=$YearStartAccount-1;
          $YearEndAccount_LastAcc=$YearStartAccount;
          $ProductDetilLastYearReport="select SUM(a.amount)as'suminlastAcc' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and a.productid=$productid and a.categoryID=$categoryID and a.statusfile=0
          and a.createdate BETWEEN '$YearStartAccount_LastAcc-10-01' AND '$YearEndAccount_LastAcc-09-30'";
          foreach ($this->db->query($ProductDetilLastYearReport)->result() as $rspro3){
    $suminlastAcc=$rspro3->suminlastAcc;
  }
?>
        <tr>
          <td class='text-center'><?php echo show_day($YearStartAccount.'-10-01'); ?></td>
          <td>ยอดยกมาปีงบประมาณ <?php echo ($YearStartAccount+543);  ?></td>
          <td></td>
          <td style="text-align:right;"><?php echo $suminlastAcc;  ?></td>
          <td style="text-align:right;"><?php echo number_format($price,2);  ?></td>
          <td style="text-align:right;">
            <?php 
            $ShowSumAmount= $suminlastAcc*$price;  
            echo number_format($ShowSumAmount,2);  
            ?>
          </td>          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td style="text-align:right;"><?php echo $amushow=$suminlastAcc;  ?></td>
          <td style="text-align:right;">
            <?php 
            $ShowSumAmount= abs($suminlastAcc*$price);  
            echo number_format($ShowSumAmount,2);  
            ?>
          </td>
        </tr>
    <?php
    $sellerName="";
    $ProductDetilOrderfileReport="select * from tb_orderfile as o , tb_product as p 
    where p.id=o.productID and o.statusfile='0' and o.productid='$productid' 
    and o.createdate BETWEEN '$YearStartAccount-10-01' AND '$YearEndAccount-09-30'
    order by o.createdate ASC";
    foreach ($this->db->query($ProductDetilOrderfileReport)->result() as $rspro2){
      $createdate=$rspro2->createdate;
      $productName=$rspro2->productName;
      $categoryID=$rspro2->categoryID;
      $amount=$rspro2->amount;
      $price=$rspro2->price;
      $productID=$rspro2->productID;
      $cusid=$rspro2->cusid;
      $sellerID=$rspro2->sellerID;
      $cusid=$rspro2->cusid;
      $statusOrder=$rspro2->statusOrder;
      $detail=$rspro2->detail;
      $NumProductID=$rspro2->NumProductID;
      $productprice=$rspro2->price;
    ?>
    <tr>
      <td class='text-center'>
          <?php   
          echo show_day($createdate);
          ?>
      </td>
      <td><?php 
            $sql4 = "select * from tb_customer where cusid=$cusid"; // ดึงข้อมูลจากตาราง product
            foreach ($this->db->query($sql4)->result() as $row4)
              $cusfullname = $row4->fullname;

            $sql5 = "select * from tb_seller where sellerID=$sellerID"; // ดึงข้อมูลจากตาราง product
            foreach ($this->db->query($sql5)->result() as $row5)
              $sellerName = $row5->sellerName;
            
            if ($statusOrder=='in'){
              echo  $sellerName.$detail;
            }else if($detail==null){
              echo  $cusfullname;
            }else{
              echo $detail;
            }
            
 ?></td>
  
<?php 
          $amountcheck=$statusOrder;
      if ($amountcheck=='ou'){
          $de1=0;
          $de2=0;
          $de3=0;
          $wi1=abs($amount); 
          $wi11=$amount; 
          $wi2=$productprice;
          $wi3=(abs($amount))*($productprice);
      }else if($amountcheck=='in'or'am'){
          $de1=$amount;
          $de2=$productprice;
          $de3=$amount*$productprice;
          $wi11=null; 
          $wi1=0;
          $wi2=0;
          $wi3=0;
        } ?>
      <td style="text-align:right;" ><?php echo  $NumProductID; ?></td>    
      <td style="text-align:right;" ><?php echo  $de1; ?></td>
      <td style="text-align:right;" ><?php echo  number_format($de2,2); ?></td>
      <td style="text-align:right;" ><?php echo  number_format($de3,2); ?></td>
      <td style="text-align:right;" ></td>
      <td style="text-align:right;" ><?php echo  $wi1; ?></td>
      <td style="text-align:right;" ><?php echo  number_format($wi2,2); ?></td>
      <td style="text-align:right;" ><?php echo  number_format($wi3,2); ?></td>
      <td style="text-align:right;" ><?php   $amushow=($amushow+$de1)+$wi11; echo  number_format($amushow);?></td>
      <td style="text-align:right;" ><?php   $totalshow=$amushow*$productprice; echo number_format($totalshow,2); ?></td>

    </tr> 
    <?php 
        $sumamushow = $sumamushow + $amushow;
        $sumtotalshow = $sumtotalshow + $totalshow;

        $showinc=$showinc+$de1;
        $showout=$showout+$wi1;
      ?>
<?php 
    } 
    if($this->db->query($ProductDetilOrderfileReport)->result() == null){
      echo "true";
    }else{
?>
        <tr class="table-active">
          <td style="text-align:right;" ></td>
          <td style="text-align:right;" >ยอดรวม</td>    
          <td style="text-align:right;" ></td>
          <td style="text-align:right;" ><?php echo  $showinc; ?></td>
          <td style="text-align:right;" ><?php echo  $productprice; ?></td>
          <td style="text-align:right;" ><?php echo  number_format($showinc*$productprice); ?></td>
          <td style="text-align:right;" ></td>
          <td style="text-align:right;" ><?php echo  $showout; ?></td>
          <td style="text-align:right;" ><?php echo  $productprice; ?></td>
          <td style="text-align:right;" ><?php echo  number_format($showout*$productprice); ?></td>
          <td style="text-align:right;" ><?php echo  number_format($sumamushow) //$sumamoute=number_format($showinc-$showout); ?></td>
          <td style="text-align:right;" ><?php echo   number_format($sumtotalshow,2) //$totalshow; ?></td>
        </tr>
<?php 
    }
?>

      </table>

    </div>
    <div class="btn-group btn-group-toggle col  d-print-none" >
      <a href="<?php echo site_url('report/Categoryreporedetail/'.$categoryID.'/'.$YearAccount);?>" id="non-printable" class="btn btn-danger   btn-sm col">ย้อนกลับ</a>
      <button name="print" type="submit" id="print" value="Print" onClick="window.print()" class="btn btn-info  btn-sm col">พิมพ์</button>
    </div>
  </div>  
</div>  
  
