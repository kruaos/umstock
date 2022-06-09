<?
include "../member/chksession.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>UMStock</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body> 
<?php 
include "../config/navmenu.php";

?>


<div class="container" style="margin-top:30px">
  <div class="row">
  <div class="col-md-12">
           
   <?php
  include "../config/connect.php";
  $categoryID=$_GET['categoryID']; 
  $sql = "select * from tb_customer where status='1' order by cusid ;"; 
  $result = mysql_db_query($dbname, $sql);
  ?>
  <h1>รายงานพัสดุ จำแนกบุคคล</h1>     
    <table width='100%' class="table table-hover table-sm small"><tr class='text-center'>
          <th width='5%'><b>ลำดับ</b></th>
          <th width='20%'><b>บุคลากร</b></th>
          <th width='10%'><b>..</b></th>
          <th width='10%'><b>จำนวนเงินเบิก</b></th>
          <th width='10%'><b>..</b></th>
          <th width='10%'><b>แผนงานที่เกี่ยวข้อง</b></th>
          <th width='10%'><b>หมายเหตุ</b></th>
      </tr>
    
    <?php
    while ($row = mysql_fetch_array($result)) {
      $cusid = $row["cusid"];	 
            
      $sql8 = "select SUM(a.amount*b.price)as'sumin' 
      from tb_orderfile as a inner join tb_product as b on a.productID=b.id 
      where a.statusfile='0' and a.cusid=$cusid and a.statusfile=0";
      $result8 = mysql_db_query($dbname, $sql8);
      $row8 = mysql_fetch_array($result8);
      if(abs($row8['sumin'])>=1){
        $sql1 = "select * from tb_customer where cusid=$cusid"; 
        $result1 = mysql_db_query($dbname, $sql1);
        while ($row1 = mysql_fetch_array($result1)) {
          $fullname = $row1["fullname"];	 

?>
    <tr class='text-center <?= $showdanger; ?>'>
        <td ><?php echo $num = $num + 1; ?></td>
        <td class="text-left" >
        <?php 
        echo "<a href='ReportDetailCus.php?cusid=".$cusid."'>" . $fullname . "</a>";
        ?></td>
        <td >..</td>
          <td class='text-right'>
          <?php 
          echo  $sumin = number_format(abs($row8['sumin']));
          ?>          
          </td>
          <td class='text-right'>..</td>
          <td>..</td>
          <td class='text-right'>..</td>
    </tr>
      <?
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
        <?
        mysql_close($Conn);
        ?>
   
   <a href="../main.php" id="non-printable" class="btn btn-danger  col-md">ย้อนกลับ</a>

    </div>
  </div>
  </div>
<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 </p>
</div>
</body>
</html>
