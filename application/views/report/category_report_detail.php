
<div class="container col-12" style="margin-top:70px">
  <div class="row">
  <div class="col-md-12">
           
   <?php
    $YearAccount=$this->uri->segment(4);
    $YearStartAccount=1957+$YearAccount-1;
    $YearEndAccount=1957+$YearAccount;

    $num=0;$suminall=0;$sumoutall=0;
  // print_r($category);exit;
  foreach ($category as $rs_category) {
    $categoryID=$rs_category->categoryID;
    $categoryName=$rs_category->categoryName;
    $divisionname=$rs_category->divisionname;
    $catestatus=$rs_category->catestatus;
    $planID=$rs_category->planID;
  }
  if(isset($categoryID)){
    $sql = "select * from tb_product where statusproduct='0' order by productname ;"; 
  }else{
    $sql = "select * from tb_product where statusproduct='0' and categoryID=$categoryID order by productname ;"; 
  }

  ?>
  <!-- <h1>รายงานพัสดุ บัญชี <?php echo $categoryName.'/'.$YearStartAccount.'/'.$YearEndAccount    ;?></h1>      -->
  <h1>รายงานพัสดุ บัญชี <?php echo $categoryName.' ปีงบประมาณ '.($YearAccount+2500)  ;?></h1>     
    <table width='100%' class="table table-hover table-sm small"><tr class='text-center'>
          <th width='5%'><b>ลำดับ</b></th>
          <th width='20%'><b>ชื่อพัสดุ</b></th>
          <th width='10%'><b>ราคา</b></th>
          <th width='10%'><b>รับ (บาท)</b></th>
          <th width='10%'><b>จ่าย (บาท)</b></th>
          <th width='10%'><b>คงเหลือ(บาท)</b></th>
          <th width='10%'><b>คงเหลือ(ชิ้น)</b></th>
      </tr>
    
    <?php
      foreach ($category_mix_product as $row) {
      $productID = $row->id;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $productName = $row->productName;	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $productPrice = $row->price; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
      $categoryID = $row->categoryID;

      $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 
      ";
      
      foreach ($this->db->query($sql2)->result() as $row2) {

        $sumamo = number_format($row2->sumamo);
        if ($sumamo == 0) {
          $showdanger = 'alert alert-danger';
        } else if ($sumamo <= 2) {
          $showdanger = 'alert alert-warning ';
        } else {
          $showdanger = '';
        }
        ?>
    <tr class='text-center <?= $showdanger; ?>'>
      <td ><?php echo $num = $num + 1; ?></td>
      <td class="text-left" >
        <a href="<?php echo site_url('report/ReportDetail/'.$productID.'/'.$YearAccount);?>"><?php echo $productName;?></a>
      </td>
 
          <td  class='text-right'>
            <?php echo number_format($productPrice,2)." บาท"; ?>
          </td>
          <td class='text-right'>
            <?php 
            $YearStartAccount_LastAcc=$YearStartAccount-1;
            $YearEndAccount_LastAcc=$YearStartAccount;
            $LastAccSum = "select SUM(a.amount*b.price)as'suminlastAcc' 
            from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
            where a.statusfile='0' and a.productid=$productID and a.categoryID=$categoryID and a.statusfile=0
                and createdate BETWEEN '$YearStartAccount_LastAcc-10-01' AND '$YearEndAccount_LastAcc-09-30'";
            foreach ($this->db->query($LastAccSum)->result() as $RLastAccSum);
            $LastAccount = $RLastAccSum->suminlastAcc;
            $sql8 = "SELECT SUM(a.amount*b.price)as'sumin' 
            from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
            where a.statusfile='0' and (a.statusOrder='in' or a.statusOrder='am') 
                and a.productid=$productID and a.categoryID=$categoryID and a.statusfile=0
                and createdate BETWEEN '$YearStartAccount-10-01' AND '$YearEndAccount-09-30'";
            foreach ($this->db->query($sql8)->result() as $row8);
            $NowAccount=$row8->sumin;
            $AmountAcc=$LastAccount+$NowAccount;
            // echo $LastAccount;
            echo number_format($AmountAcc,2);
            // echo $sql8;
            ?>          
          </td>
          <td class='text-right'>
          <?php 
            $sql9 = "select SUM(a.amount*b.price)as'sumout' 
            from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
            where a.statusfile='0' and a.statusOrder='ou' and a.productid=$productID 
                and a.categoryID=$categoryID and a.statusfile=0
                and createdate BETWEEN '$YearStartAccount-10-01' AND '$YearEndAccount-09-30'";
            foreach ($this->db->query($sql9)->result() as $row9)

            $sumout = abs($row9->sumout);
            echo  number_format($sumout,2);

?>          
          </td>
          <td  class='text-right'>
          <?php 
          $suminall=$suminall+($row8->sumin);
          $sumoutall=$sumoutall+($row9->sumout);
          // echo   number_format(($row8->sumin)-abs($row9->sumout));
          $ShowAmount=$AmountAcc-$sumout;
          echo   number_format($ShowAmount,2);
          ?>          
          </td>
          <td>
          <?php
          if ($sumamo == 0) {
            echo " <span class=' badge-danger'> หมด </span>";
          } elseif ($sumamo <= 2) {
            echo " <span class=' badge-warning'> จำนวน ".number_format($sumamo,2)." ชิ้น </span>";
          } else{
            echo number_format($sumamo,2);
          }
        }
        ?> 
          </td>
    </tr>

<?php 
    } ?>
      <tr class='text-center'>
            <td ></td>
            <td >รวม</td>
            <td ></td>
            <td  class='text-right'><?= number_format($suminall,2);?></td>
            <td  class='text-right'><?= number_format(abs($sumoutall),2);?></td>
            <td  class='text-right'>
              <?php 
              $ShowAmountReport=$suminall+$sumoutall;
              echo number_format($ShowAmountReport,2);
              ?></td>
            <td ></td>
          </tr>
        </table>

   <a href="<?php echo site_url('report/CategoryReport');?>" id="non-printable" class="btn btn-danger  col-md">ย้อนกลับ</a>

