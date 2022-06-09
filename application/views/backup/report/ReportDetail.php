<?
include "../member/chksession.php";
date_default_timezone_set("Asia/Bangkok");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>UMStock</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link href="../config/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="../config/dist/js/bootstrap-datepicker-custom.js"></script>
<script src="../config/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
<style type="text/css">     
  
  #printable { display: block; }  
    
  @media print   
  {   
       #non-printable { display: none; }   
       #printable { display: block; }   
  }   
    
  </style>  


</head>
<body> <?php 
  include "../config/navmenu.php";
?>


<div class="container" style="margin-top:30px" >
  <div class="row">
    <div class="col-xs-1"></div>
    <div class="col-sm-12 col-md-12 col-xs-12" style="font-family: 'Sarabun', sans-serif; font-Size:12pt">

  <?php
        include "../config/connect.php";

        $productid=$_GET['productid'];
        $categoryID=$_GET['categoryID'];


        $sql = "select * from tb_orderfile where statusfile='0' and categoryID=$categoryID and productid='$productid' order by createdate ASC;"; // ดึงข้อมูลจากตาราง product
        $result = mysql_db_query($dbname,$sql);

        $sql2 = "select * from tb_product where id=$productid"; // ดึงข้อมูลจากตาราง product
        $result2 = mysql_db_query($dbname,$sql2);
        while($row2 = mysql_fetch_array($result2)){ 
          $productName = $row2["productName"];
        }
        
        ?>
    <h3  class='text-center'>บัญชีพัสดุ<br> </h3><h4  class='text-center'> <b>ประเภท : </b><?php echo $productName;?> </h4>
    <table width='100%' class="table table-hover table-sm table-bordered" boder='1'>
    
    <tr class='text-center '>
          <th width='10%'class='text-center 'rowspan="2">วันที่ </th>
          <th width='15%'rowspan="2">รายการ</th>
          <th width='25%'colspan="4">รับ</th>
          <th width='25%'colspan="4">จ่าย</th>
          <th width='25%'colspan="2">คงเหลือ</th>

    </tr>
    <tr class='text-center '>          
          <th width='5%' ><p class="small">ใบรับที่</th>
          <th width='5%' ><p class="small">จำนวน</th>
          <th width='7%'><p class="small">ราคาต่อหน่วย<p></th>
          <th width='5%' ><p class="small">เงิน</th>
          <th width='5%' ><p class="small">ใบสั่งที่</th>
          <th width='5%' ><p class="small">จำนวน</th>
          <th width='7%' ><p class="small">ราคาต่อหน่วย<p></th>
          <th width='5%' ><p class="small">เงิน</th>
          <th width='5%'><p class="small">จำนวน</th>
          <th width='5%'><p class="small">เงิน</th>


        </tr>

    <?php
        $amushow=0;
        while($row = mysql_fetch_array($result)){ 

    ?>
    <tr>
      <td class='text-center'><?php       
      $showmont=array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
      
      $showdate=number_format(substr($row["createdate"],8,2))." ".$showmont[number_format(substr($row["createdate"],5,2))-1]." ".(substr($row["createdate"],2,2)+43);
      echo $showdate;
      ?></td>
      <td><?php 
            $productID=$row["productID"];
            $sql1 = "select * from tb_product where id=$productID"; // ดึงข้อมูลจากตาราง product
            $result1 = mysql_db_query($dbname,$sql1);
            while($row1 = mysql_fetch_array($result1)){ 
              $productName = $row1["productName"];
              $productprice= $row1["price"];
            }
            $cusid=$row["cusid"];
            $sql4 = "select * from tb_customer where cusid=$cusid"; // ดึงข้อมูลจากตาราง product
            $result4 = mysql_db_query($dbname,$sql4);
            while($row4 = mysql_fetch_array($result4)){ 
              $cusfullname = $row4["fullname"];
            }
            $sellerID=$row["sellerID"];
            $sql5 = "select * from tb_seller where sellerID=$sellerID"; // ดึงข้อมูลจากตาราง product
            $result5 = mysql_db_query($dbname,$sql5);
            while($row5 = mysql_fetch_array($result5)){ 
              $sellerName = $row5["sellerName"];
            }
            
            
            if ($row["statusOrder"]=='in'){
              echo  $sellerName.$row["detail"];;
            }else if($row["detail"]==null){
              echo  $cusfullname;
            }else{
              echo $row["detail"];
            }
            
 ?></td>
  
<?php 
          $amountcheck=$row["statusOrder"];
      if ($amountcheck=='ou'){
          $de1="";
          $de2="";
          $de3="";
          $wi1=number_format(abs($row["amount"])); 
          $wi11=$row["amount"]; 
          $wi2=number_format($productprice);
          $wi3=number_format(abs($row["amount"])*($productprice));
      }else if($amountcheck=='in'or'am'){
          $de1=number_format($row["amount"]);
          $de2=number_format($productprice);
          $de3=number_format($row["amount"]*$productprice);
          $wi11=null; 
          $wi1='';
          $wi2='';
          $wi3='';
        } ?>
      <td style="text-align:right;" ><?php echo  $row["NumProductID"]; ?></td>    
      <td style="text-align:right;" ><?php echo  $de1; ?></td>
      <td style="text-align:right;" ><?php echo  $de2; ?></td>
      <td style="text-align:right;" ><?php echo  $de3; ?></td>
      <td style="text-align:right;" ></td>
      <td style="text-align:right;" ><?php echo  $wi1; ?></td>
      <td style="text-align:right;" ><?php echo  $wi2; ?></td>
      <td style="text-align:right;" ><?php echo  $wi3; ?></td>
      <td style="text-align:right;" ><?php   $amushow=($amushow+$de1)+$wi11; echo  number_format($amushow);?></td>
      <td style="text-align:right;" ><?php   $totalshow=$amushow*$productprice; echo number_format($totalshow); ?></td>

    </tr> 
    <?php 
        $sumamushow = $sumamushow + $amushow;
        $sumtotalshow = $sumtotalshow + $totalshow;

        $showinc=$showinc+$de1;
        $showout=$showout+$wi1;
      ?>
      <?    } ?>
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
      <td style="text-align:right;" ><?php echo   number_format($sumtotalshow) //$totalshow; ?></td>

      
      </tr>
        </table>
        <? 
        mysql_close($Conn);
        ?>
        <div class="row">
      <a href="ReportProduct.php?categoryID=<?=$categoryID?>" id="non-printable" class="btn btn-danger   btn-sm col">ย้อนกลับ</a>
      <button id="non-printable" name="print" type="submit" id="print" value="Print" onClick="window.print()" class="btn btn-info   btn-sm col">พิมพ์</button>
</div>

    </div>
    <div class="col-sx-1"></div>
  </div>
  
</div>
<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>

</body>
</html>
