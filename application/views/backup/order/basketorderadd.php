<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link href="../config/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="../config/dist/js/bootstrap-datepicker-custom.js"></script>
<script src="../config/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

<?php
date_default_timezone_set("Asia/Bangkok");
include "../config/connect.php";
include "../member/chksession.php";


$dateOrder=$_POST['dateOrder'];
$categoryID=$_POST['categoryID'];
$cusid=$_POST['cusid'];
$dayneed=$_POST['dayneed'];
$explain=$_POST['explain'];
// 0. ทำการนับค่าออเดอร์ว่ามีกี่ชิ้น 

$sql3 = "select * from tb_order where memberID=$sess_memberid"; // ดึงข้อมูลจากตาราง product
$result3 = mysql_db_query($dbname, $sql3);
$total_record =mysql_num_rows($result3)+1;
while ($row3 = mysql_fetch_array($result3)) {

}

$memberID=$sess_memberid;

$createdate=(substr($dateOrder,6,4)-543)."-".substr($dateOrder,3,2)."-".substr($dateOrder,0,2).date(" H:m:s");
$needdaydate=(substr($dayneed,6,4)-543)."-".substr($dayneed,3,2)."-".substr($dayneed,0,2);
$orderNum=$sess_memberid.$total_record;
$staff1='0';
$staff2='0';
$staff3='0';
$status='1';


$sql1="INSERT INTO tb_order VALUES('','$orderNum','$memberID', '$explain','$needdaydate',
									'$staff1', '$staff2', '$staff3', '$createdate', '$status','0') ";
		$result1= mysql_db_query($dbname,$sql1);

$price='0';
$statusfile='0';
$statusOrder='ou';
//	echo $sql1."<hr>";

$sql3 = "select * from tb_basket where memberID=$memberID"; // ดึงข้อมูลจากตาราง product
$result3 = mysql_db_query($dbname,$sql3);
while($row3 = mysql_fetch_array($result3)){ 
  $basketID = $row3["basketID"];
  $productID = $row3["productID"];
  $amount = $row3["quantity"];
  	$sql4="INSERT INTO tb_orderdetail VALUES ('', '$createdate', '$productID', '$categoryID', '$orderNum',
  		'$statusOrder', '$amount', '$price', '$explain', '$statusfile', '$cusid', '$needdaydate')";
	$sql5="INSERT INTO tb_orderfile VALUES ('', '$createdate', '$productID', '$categoryID', '$orderNum',
   		'$statusOrder', '-$amount', '$price', '$explain', '$statusfile', '$cusid', '0','')"; 
  	$sql6="DELETE FROM tb_basket where  basketID=$basketID";

//	echo $sql4."<br>".$sql5."<br>";
  		$result4= mysql_db_query($dbname,$sql4);
		$result5= mysql_db_query($dbname,$sql5);
		$result6= mysql_db_query($dbname,$sql6);
		if ($result4) {
			//echo $sql4."<br>".$sql5."<br>";
			$showreport="บันทึกข้อมูล<br>";
		} else if ($result5) {
			//echo $sql4."<br>".$sql5."<br>";
			$showreport="บันทึกข้อมูล<br>";
		} else if ($result6) {
			//echo $sql4."<br>".$sql5."<br>";
			$showreport="บันทึกข้อมูล<br>";
		} else {
			echo $sql4."<br>".$sql5."<br>".$sql6."<br>";
			$showreport="เงื่อนไขทีไม่สำเร็จ<br>";
		}
	}
	echo $showreport;
	header("Location: ../report/printorder.php");
	?>

<?php
mysql_close($Conn);

?>