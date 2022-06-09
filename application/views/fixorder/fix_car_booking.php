<div class="container ">
  <div class="row">
<?php 
	// ดึงข้อมูล customer
	// ดึงข้อมูล รถ  carincrease
    date_default_timezone_set("Asia/Bangkok");
	$month_show=array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤษจิกายน','ธันวาคม');
	$month_count=array('0','31','28','31','30','31','30','31','31','30','31','30','31');

// foreach ($car_max_order as $crmx){
// 	$carmax_i=($crmx->car_max_order)+1;
// }

?>
  <div class="p-2 bg-warning   rounded col-12">
	รายการบันทึกขอซ่อม
  </div>

		<form class="col-md-12" method="POST" action="<?php echo site_url('/carorder/fixcarbookingadd');?>">
		  <div class="form-group">
		    <label ><b>ชื่อ : </b></label> <?php echo $this->session->userdata('fullname');?> 
		    <input type="hidden" class="form-control" value='<?php echo $this->session->userdata('userid');?>' name="oil_order_customerID" >
		  </div>
		<div class="form-row">
			<div class="form-group col-md-4">
			<label > รับผิดชอบรถ หมายเลขทะเบียน</label>
			<select class="form-control" name="car_member_display" >
				<?php 
				foreach ($car_member_show_all as $cr_show) {
				?>
			  <option ><?php echo $cr_show->car_member_display;?></option>
				<?php 
				}
				?>
			</select>
			</div>
			<div class="form-group col-md-2">
				<label >ชนิด</label>
				<select class="form-control" name="oil_order_oil_type" >
					<option >ไบโอดีเซล</option>
					<option >ดีเซล</option>
					<option >เบนซิน</option>
					<option >อื่นๆ</option>
				</select>					
			</div>
			<div class="form-group col-md-2">
				<label >จำนวน </label>
				<input type="text" class="form-control" placeholder="ลิตร" name="oil_order_quantity" >
			</div>
			<div class="form-group col-md-4">
			<label > เพื่อใช้กับรถ หมายเลขทะเบียน</label>
				<select class="form-control" name="car_order_car_number" >
					<?php 
					foreach ($car_member_show_all as $cr_show) {
					?>
				  <option value="<?php echo $cr_show->car_member_number;?>" name=""><?php echo $cr_show->car_member_display;?></option>
					<?php 
					}
					?>
				</select>
			</div>	


		</div>

		  <div class="form-row ">
			<div class="form-group col">
			    <label >ระยะทาง กม./ไมล์ เมื่อขอเบิก</label>
			    <input type="text" class="form-control" placeholder="ตัวเลข" name="oil_order_mile" >
			</div>
			<div class="form-group col">
			    <label >หัวหน้าฝ่าย/ ผอ.กอง</label>
				<select class="form-control" name="oil_order_manager1_approve" >
			    	<?php 
			    	foreach ($customer_show_boss as $rs) {
			    	?>
			      <option value="<?php echo $rs->cusid;?>" name=""><?php echo $rs->fullname;?></option>
			    	<?php 
			    	}
			    	?>
			    </select>			  
			</div>


		  		<div class="form-group col-md alert-warning">
			    <label >วันที่ขอเบิกล่าสุด</label>
				    <div class="form-row">
				  		<div class="form-group col-3 ">
				  			<select class="form-control" name="day_use" >
				  				<?php 
				  				$month_number=number_format(date('m'));
				  				$day_count=$month_count[$month_number];
				  				$day_now=number_format(date('d'));
				  				for($day_i=1;$day_i<=$day_count;$day_i++)
				  				{
								?>	
							      <option <?php if($day_i==$day_now){echo 'selected';}?> ><?php echo $day_i;?></option>
								<?php 
				  				}
							    ?>
						    </select>
				  		</div>
				  		<div class="form-group col-5">
				  			<select class="form-control" name="month_use" >
				  				<?php 
				  				$month_number=number_format(date('m'));
				  				$day_now=number_format(date('d'));
				  				for($month_i=1;$month_i<=12;$month_i++)
				  				{
								?>	
							      <option value="<?php echo $month_i; ?>" <?php if($month_i==$month_number){echo 'selected';}?> ><?php echo $month_show[$month_i];?></option>
								<?php 
				  				}
							    ?>
						    </select>			  		
						</div>
				  		<div class="form-group col-4">
				  			<select class="form-control" name="year_use" >
				  				<?php 
				  				$year_now=date('Y');
				  				$year_start=$year_now-10;
				  				$year_stop=$year_now+10;
				  				for($year_i=$year_start;$year_i<=$year_stop;$year_i++)
				  				{
								?>	
							      <option value="<?php echo $year_i; ?>"  <?php if($year_i==$year_now){echo 'selected';}?>  ><?php echo $year_i+543;?></option>
								<?php 
				  				}
							    ?>
						    </select>
						    </div>
				  	</div>
			  	</div>
			  </div>


		  <div class="form-row ">
		  	<div class="btn-group col">
			  	<a href="<?php echo site_url('');?>" class="btn btn-danger  col ">ยกเลิก</a>
			  	<button type="submit" class="btn btn-primary col ">ทำรายการ</button>
		  	</div>
		  </div>
		</form>


  </div>
</div>

