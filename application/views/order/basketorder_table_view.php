    <h3>สถานะการบันทึกบัญชี</h3>

    <table  class="table table-hover  small table-sm  "><tr class='text-center'>
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
        // $sql = "select * from tb_orderfile where statusfile='0' and categoryID=$cateID order by createdate DESC limit {$startpage} , {$perpage} ;"; // ดึงข้อมูลจากตาราง product
        // $result = mysql_db_query($dbname, $sql);
        // while ($row = mysql_fetch_array($result)) {
      ?>
    <tr>
      <td class='text-center'><?php 
                              // $showmont = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
                              // $showdate = number_format(substr($row["createdate"], 8, 2)) . " " . $showmont[number_format(substr($row["createdate"], 5, 2)) - 1] . " " . (substr($row["createdate"], 2, 2) + 43);
                              // echo $showdate;
                              ?></td>
      <td><?php 
          // $productID = $row["productID"];
          // $cusid = $row["cusid"];
          // $categoryID = $row["categoryID"];
          // $sql1 = "select * from tb_product where id=$productID";
          // $result1 = mysql_db_query($dbname, $sql1);
          // while ($row1 = mysql_fetch_array($result1)) {
          //   $productName = $row1["productName"];
          //   $productprice = $row1["price"];
          // }
          // $sql2 = "select * from tb_customer where cusid=$cusid";
          // $result2 = mysql_db_query($dbname, $sql2);
          // while ($row2 = mysql_fetch_array($result2)) {
          //   $fullname = $row2["fullname"];
          // }

          // echo "<a href='orderdetail.php?productid=" . $productID . "'>" . $productName . "</a>";
          echo "<a href=''></a>";

          ?>
            
          </td>
      <td>

      <?php 
            // $cusid=$row["cusid"];
            // $sql7 = "select * from tb_customer where cusid=$cusid"; // ดึงข้อมูลจากตาราง product
            // $result7 = mysql_db_query($dbname,$sql7);
            // while($row7 = mysql_fetch_array($result7)){ 
            //   $cusfullname = $row7["fullname"];
            // }
            // $sellerID=$row["sellerID"];
            // $sql8 = "select * from tb_seller where sellerID=$sellerID"; // ดึงข้อมูลจากตาราง product
            // $result8 = mysql_db_query($dbname,$sql8);
            // while($row8 = mysql_fetch_array($result8)){ 
            //   $sellerName = $row8["sellerName"];
            // }
            
            
            // if ($row["statusOrder"]=='in'){
            //   echo  $sellerName.$row["detail"];;
            // }else if($row["detail"]==null){
            //   echo  $cusfullname;
            // }else{
            //   echo $row["detail"];
            // }
 ?>
    
    </td>
      <?php 
      // $amountcheck = $row["statusOrder"];
      // if ($amountcheck == 'ou') {
      //   $de1 = "";
      //   $de2 = "";
      //   $de3 = "";
      //   $wi1 = abs($row["amount"]);
      //   $wi2 = $productprice;
      //   $wi3 = number_format($wi1 * $wi2);
      // } else {
      //   $de1 = $row["amount"];
      //   $de2 = $productprice;
      //   $de3 = number_format($de1 * $de2);
      //   $wi1 = "";
      //   $wi2 = "";
      //   $wi3 = "";
      // } 

        $de1 = "";
        $de2 = "";
        $de3 = "";
        $wi1 = "";
        $wi2 = "";
        $wi3 = "";


      ?>
      <td style="text-align:right;" ><?php echo $de1; ?></td>
      <td style="text-align:right;" ><?php echo $de2; ?></td>
      <td style="text-align:right;" ><?php echo $de3; ?></td>
      <td style="text-align:right;" ><?php echo $wi1; ?></td>
      <td style="text-align:right;" ><?php echo $wi2; ?></td>
      <td style="text-align:right;" ><?php echo $wi3; ?></td>
      <td style="text-align:center;" >
      <a class="btn btn-primary btn-sm" href='addorderedit.php?idedit=<?php echo $row["orderFileID"];?>'><div class='small'>แก้ไข</div></a>
      <a class="btn btn-danger btn-sm" href='addorderdel.php?id_del=<?php echo $row["orderFileID"]; ?>&categoryID=<?php echo $categoryID;?>'><div class='small'>ลบ</div></a></td>
    </tr>  

<?php
// }

?>
        </table>

    </div>
  </div>
</div>

