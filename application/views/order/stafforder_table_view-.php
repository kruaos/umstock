<div class="container col-md-12 ">

<div class="col-sm-12 col-md-12 col-xs-12" >
    <h3>สถานะการบันทึกบัญชี</h3>
    <table  class="table table-hover  small table-sm  ">
      <tr class='text-center'>
          <th width='10%'class='text-center'>วันที่ </th>
          <th >พัสดุ</th>
          <th >รายการ</th>
          <th width='5%' style="background-color:MediumSeaGreen;">รับ</th>
          <th width='5%' style="background-color:MediumSeaGreen;">ราคา</th>
          <th width='5%' style="background-color:MediumSeaGreen;">รวม</th>
          <th width='5%' style="background-color:Tomato;">จ่าย</th>
          <th width='5%' style="background-color:Tomato;">ราคา</th>
          <th width='5%' style="background-color:Tomato;">รวม</th>
          <th width='10%'>แก้ไข</th>
        </tr>
        <?php
    $cateID=$this->uri->segment(3);

        $sql = "select * from tb_orderfile where statusfile='0' and categoryID=$cateID order by createdate DESC "; // ดึงข้อมูลจากตาราง product
        $rsorderfile = $this->db->query($sql);
        foreach ($rsorderfile->result() as $row) {
          $createdate=$row->createdate;
        ?>
    <tr>
      <td class='text-center'><?php 
                              $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
                              $showdate = number_format(substr($createdate, 8, 2)) . " " . $showmont[number_format(substr($createdate, 5, 2)) - 1] . " " . (substr($createdate, 2, 2) + 43);
                              echo $showdate;
                              ?>
      </td>
      <td><?php 
          $productID = $row->productID;
          $cusid = $row->cusid;
          $categoryID = $row->categoryID;
            $sql1 = "select * from tb_product where id=$productID";
            $result1 = $this->db->query($sql1);
            foreach ($result1->result() as $row1) {
              $productName = $row1->productName;
              $productprice = $row1->price;

            }
            $sql2 = "select * from tb_customer where cusid=$cusid";
            $result2 = $this->db->query($sql2);
            foreach ($result2->result() as $row2) {
              $fullname = $row2->fullname;
            }

          echo "<a href='orderdetail.php?productid=" . $productID . "'>" . $productName . "</a>"; ?>
      </td>
      <td>
    
      <?php 
            $cusid=$row->cusid;
              $sql7 = "select * from tb_customer where cusid=$cusid"; // ดึงข้อมูลจากตาราง product
              $result7 = $this->db->query($sql7);
              foreach ($result7->result() as $row7) {
                $cusfullname = $row7->fullname;
                }

              $sellerID=$row->sellerID;
              $sql8 = "select * from tb_seller where sellerID=$sellerID"; // ดึงข้อมูลจากตาราง product
              $result8 = $this->db->query($sql8);
              foreach ($result8->result() as $row8) {                
                $sellerName = $row8->sellerName;
              }
            if ($row->statusOrder=='in'){
              echo  $sellerName.$row->detail;
            }else if($row->detail==null){
              echo  $cusfullname;
            }else if($row->statusOrder=='ou' and $row->cusid=='0' ){
              echo $row->detail;
            }else{
              echo $cusfullname;
            }
            
 ?>
      
      </td>
        <?php 
        $amountcheck = $row->statusOrder;
        if ($amountcheck =='ou') {
          $de1 = "";
          $de2 = "";
          $de3 = "";
          $wi1 = number_format(abs($row->amount),2);
          $wi2 = number_format($productprice,2);
          $wi3 = number_format(($wi1 * $wi2),2);
        } else {
          $de1 = number_format($row->amount,2);
          $de2 = number_format($productprice,2);
          $de3 = number_format(($de1 * $de2),2);
          $wi1 = "";
          $wi2 = "";
          $wi3 = "";
        } ?>
        <td style="text-align:right;" ><?php echo $de1; ?></td>
        <td style="text-align:right;" ><?php echo $de2; ?></td>
        <td style="text-align:right;" ><?php echo $de3; ?></td>
        <td style="text-align:right;" ><?php echo $wi1; ?></td>
        <td style="text-align:right;" ><?php echo $wi2; ?></td>
        <td style="text-align:right;" ><?php echo $wi3; ?></td>
        <td style="text-align:center;" >
        <a class="btn btn-danger btn-sm" href="<?php echo site_url('order/stafforderdel/');?><?php echo $row->orderFileID;?>/<?php echo $row->categoryID;?>"><div class='small'>ลบ</div></a></td>
      </tr>  

  <?php 

  }
  ?>
  </table>
</div>

</div>
</div>