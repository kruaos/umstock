
<div class="container col-12" style="margin-top:70px">
  <div class="row">
  <div class="col-md-12">
           
   <?php
   $num=0;$suminall=0;$sumoutall=0;
  // print_r($category);exit;
 ?>
  <h1>รายงานพัสดุ ทั้งหมด</h1>     
    <table width='100%' class="table table-hover table-sm small"><tr class='text-center'>
          <th width='5%'><b>ลำดับ</b></th>
          <th width='20%'><b>ชื่อพัสดุ</b></th>
          <th width='10%'><b>ราคา</b></th>
          <th width='10%'><b>รับ</b></th>
          <th width='10%'><b>จ่าย</b></th>
          <th width='10%'><b>คงเหลือ</b></th>
          <th width='10%'><b>จำนวน</b></th>
      </tr>
    
    <?php
      foreach ($query_showall as $row) {
      $productID = $row->id;	  // เก็บรหัสสินค้าไว้ในตัวแปร $productID
      $productName = $row->productName;	  // เก็บชื่อสินค้าไว้ในตัวแปร $productName
      $productPrice = $row->price; // เก็บราคาสินค้าไว้ในตัวแปร $productPrice
      $categoryID = $row->categoryID;

      $sql2 = "SELECT SUM(amount)as'sumamo' FROM tb_orderfile WHERE productID=$productID and statusfile=0 ";
      
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
        <a href="<?php echo site_url('report/ReportDetail_showall/'.$productID);?>"><?php echo $productName;?></a>
      </td>
 
    <td ><?= number_format($productPrice)." บาท"; ?></td>
          <td class='text-right'>
          <?php 
          $sql8 = "select SUM(a.amount*b.price)as'sumin' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and (a.statusOrder='in' or a.statusOrder='am') and a.productid=$productID and a.categoryID=$categoryID and a.statusfile=0";
          foreach ($this->db->query($sql8)->result() as $row8)
          echo $sumin=number_format($row8->sumin);
          ?>          
          </td>
          <td class='text-right'>
          <?php 
          $sql9 = "select SUM(a.amount*b.price)as'sumout' 
          from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
          where a.statusfile='0' and a.statusOrder='ou' and a.productid=$productID and a.categoryID=$categoryID and a.statusfile=0"; 
          foreach ($this->db->query($sql9)->result() as $row9)

          echo  $sumout = number_format(abs($row9->sumout));
          ?>          
          </td>
          <td>
          <?php
          if ($sumamo == 0) {
            echo " <span class='badge badge-danger'>หมด</span>";
          } elseif ($sumamo <= 2) {
            echo " <span class='badge badge-warning'> จำนวน ".$sumamo." ชิ้น</span>";
          } else{
            echo $sumamo;
          }
        }
        ?> 
          </td>
          <td  class='text-right'>
          <?php 
          $suminall=$suminall+($row8->sumin);
          $sumoutall=$sumoutall+($row9->sumout);
          echo   number_format($row8->sumin-abs($row9->sumout));
          ?>          
          </td>
    </tr>

<?php 
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


