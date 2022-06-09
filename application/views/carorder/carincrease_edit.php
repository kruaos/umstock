<div class="container">
  <div class="row">
<?php 
	// ดึงข้อมูล customer
	// ดึงข้อมูล รถ  carincrease
    date_default_timezone_set("Asia/Bangkok");
	$month_show=array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤษจิกายน','ธันวาคม');
	$month_count=array('0','31','28','31','30','31','30','31','31','30','31','30','31');

foreach ($carmember_select as $crmem){

    $car_member_id=$crmem->car_member_id;
    $car_member_display=$crmem->car_member_display;
    $car_member_brand=$crmem->car_member_brand;
    $car_member_stockID=$crmem->car_member_stockID;
    $car_member_power=$crmem->car_member_power;
    $car_member_piston=$crmem->car_member_piston;
    $car_member_cusID=$crmem->car_member_cusID;
    $car_member_oil_use=$crmem->car_member_oil_use;
    $car_member_date_ownership=$crmem->car_member_date_ownership;
}
?>
		<div class="alert alert-primary col-md-12" role="alert">
			<h4>บันทึกคุรุภัณฑ์ รถ</h4>

		</div>

		<form class="col-md-12" method="POST" action="<?php echo site_url('/carorder/carincreaseupdate');?>" enctype="multipart/form-data">

		<div class="form-row">
			<div class="form-group col-3">
			    <label > หมายเลขทะเบียน</label>
				<input type="text" class="form-control" value="<?php echo $car_member_display;?>" name="car_member_display" >
				<input type="hidden" class="form-control" value="<?php echo $car_member_id;?>" name="car_member_id" >				
			</div>
			<div class="form-group col-3">
			    <label > ยี่ห้อรถยนต์</label>
				<input type="text" class="form-control" value="<?php echo $car_member_brand;?>" name="car_member_brand" >
			</div>
			<div class="form-group col-3">
			    <label > เลขคุรุภัณฑ์</label>
				<input type="text" class="form-control" value="<?php echo $car_member_stockID;?>" name="car_member_stockID" >
			</div>
			<div class="form-group col-3">
			    <label > แรงม้า </label>
				<input type="text" class="form-control" value="<?php echo $car_member_power;?>" name="car_member_power" >
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-4">
			    <label > จำนวนลูกสูบ </label>
				<input type="text" class="form-control" value="<?php echo $car_member_piston;?>" name="car_member_piston" >
			</div>
			<div class="form-group col-4">
			    <label > ผู้รับผิดชอบ</label>
			    <select class="form-control" name="car_member_cusID" >
	  				<?php 
	  				foreach ($customer as $cus_show) 
	  				{
					?>	
					<option value="<?php echo $cus_show->cusid;?>" <?php if($cus_show->cusid==$car_member_cusID){ echo "selected";}?>>
				      	<?php echo "[".$cus_show->cusid."] ".$cus_show->fullname;?>
			      	</option>
					<?php 
	  				}
				    ?>
			    </select>		
			</div>
			<div class="form-group col-4">
			    <label > กำหนดปริมาณ </label>
				<input type="text" class="form-control"  value="<?php echo $car_member_oil_use;?>" name="car_member_oil_use" >
			</div>
		</div>

		    <label >วันที่ได้มาซึ่งกรรมสิทธิ์</label>
			    <div class="form-row">
			  		<div class="form-group col-3">
			  			<select class="form-control" name="day_own" >
			  				<?php 
			  				$day_regis=substr($car_member_date_ownership,8,2);
			  				for($day_i=1;$day_i<=31;$day_i++)
			  				{
							?>	
						      <option  value="<?php echo sprintf("%02d", $day_i);?>" <?php if($day_i==$day_regis){echo 'selected';}?>><?php echo $day_i;?></option>
							<?php 
			  				}
						    ?>
					    </select>
			  		</div>
			  		<div class="form-group col-5">
			  			<select class="form-control" name="month_own">
			  				<?php 
			  				$day_regis=substr($car_member_date_ownership,5,2);
			  				$month_number=number_format(date('m'));
			  				$day_now=number_format(date('d'));
			  				for($month_i=1;$month_i<=12;$month_i++)
			  				{
							?>	
						      <option value="<?php echo sprintf("%02d",$month_i);?>" <?php if($month_i==$month_number){echo 'selected';}?>><?php echo $month_show[$month_i];?></option>
							<?php 
			  				}
						    ?>
					    </select>			  		
					</div>
			  		<div class="form-group col-4">
			  			<select class="form-control" name="year_own" >
			  				<?php 
			  				echo $year_regis=substr($car_member_date_ownership,0,4);
			  				$year_start=$year_regis-35;
			  				$year_stop=$year_regis+5;
			  				for($year_i=$year_start;$year_i<=$year_stop;$year_i++)
			  				{
							?>	
						    	<option value="<?php echo $year_i;?>" <?php if($year_i==$year_regis){echo 'selected';}?>><?php echo $year_i+543;?></option>
							<?php 
			  				}
						    ?>
					    </select>
					</div>
			  	</div>

<!-- 

https://www.youtube.com/watch?v=NX5QNWxLnkk&list=PLEA4F1w-xYVaY4qvlDOhiJAGE2QxdABK6&index=37&t=5s 

https://www.thaicreate.com/community/php-upload-file-mysql-edit-form.html

-->

		  <div class="form-row ">
		  	<div class="btn-group col">
			  	<a href="<?php echo site_url('carorder/carincrease/');?>" class="btn btn-danger  col ">ยกเลิก</a>
			  	<button type="submit" class="btn btn-success col ">บันทึกรายการ</button>
		  	</div>
		  </div>
		</form>


  </div>
</div>

