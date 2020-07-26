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
  <div class="p-2 bg-primary  text-white rounded col-12">
		ใบขออนุญาตใช้รถส่วนกลาง แบบ3

		</div>

		<form class="col-md-12" method="POST" action="<?php echo site_url('/carorder/carorderbook');?>">
		  <div class="form-group">
		    <label ><b>ชื่อ : </b></label> <?php echo $this->session->userdata('fullname');?> 
		    <!-- <label ><b>ตำแหน่ง :</b></label> <?php echo $this->session->userdata('fullname');?>  -->
			<label> ขออนุญาตใช้รถ</label>
		    <input type="hidden" class="form-control" placeholder="text" name="" >
		  </div>
		<div class="form-row">
			  <div class="form-group col-md-2">
			    <label > หมายเลขทะเบียน</label>
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
				<div class="form-group col-md-2">
					<label >สถานที่ไป</label>
					<input type="text" class="form-control" placeholder="สถานที่ ระบุ" name="car_order_target" >
					<input type="hidden" name="car_order_customer_number" value="<?php echo $this->session->userdata('userid'); ?>">
				</div>
			  <div class="form-group col-md-2">
			    <label >มีคนนั่ง </label>
			    <input type="text" class="form-control" placeholder="จำนวน คน" name="car_order_seat" >
			  </div>
			  <div class="form-group col">
			    <label >เพื่อ</label>
			    <input type="text" class="form-control" placeholder="เพื่อ" name="car_order_detail" >
			  </div>
			  <div class="form-group col">
			    <label >หัวหน้าฝ่าย/ ผอ.กอง</label>
				<select class="form-control" name="car_order_allow1" >
			    	<?php 
			    	foreach ($customer_show_boss as $rs) {
			    	?>
			      <option value="<?php echo $rs->cusid;?>" name=""><?php echo $rs->fullname;?></option>
			    	<?php 
			    	}
			    	?>
			    </select>			  </div>
		</div>

		  <div class="form-row ">
		  		<div class="form-group col-md-4 alert-info">
			    <label >ใช้วันที่</label>
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
		  		<div class="form-group col-md-2 alert-info">
			    <label >เวลา</label>
				    <div class="form-row">
				  		<div class="form-group col-6">
				  			<select class="form-control" name="h_use" >
				  				<?php 
				  				$H_now=date('H');
				  				for($H_i=0;$H_i<=24;$H_i++)
				  				{
								?>	
							      <option <?php if($H_i==$H_now){echo 'selected';}?>><?php echo sprintf("%02d",$H_i);?></option>
								<?php 
				  				}
							    ?>
						    </select>			  		
						</div>
				  		<div class="form-group col-6">
				  			<select class="form-control" name="i_use" >
				  				<?php 
				  				$M_now=date('i');
				  				for($M_i=0;$M_i<=60;$M_i++)
				  				{
								?>	
							      <option <?php if($M_i==$M_now){echo 'selected';}?>><?php echo sprintf("%02d",$M_i);?></option>
								<?php 
				  				}
							    ?>
						    </select>				  		
						</div>
				  	</div>
			  	</div>

			

	  		<div class="form-group col-md-4 alert-warning">
		    <label>ถึงวันที่</label>
			    <div class="form-row">
			  		<div class="form-group col-3">
			  			<select class="form-control" name="day_back" >
			  				<?php 
			  				$month_number=number_format(date('m'));
			  				$day_count=$month_count[$month_number];
			  				$day_now=number_format(date('d'));
			  				for($day_i=1;$day_i<=$day_count;$day_i++)
			  				{
							?>	
						      <option <?php if($day_i==$day_now){echo 'selected';}?>><?php echo $day_i;?></option>
							<?php 
			  				}
						    ?>
					    </select>
			  		</div>
			  		<div class="form-group col-5">
			  			<select class="form-control" name="month_back" >
			  				<?php 
			  				$month_number=number_format(date('m'));
			  				$day_now=number_format(date('d'));
			  				for($month_i=1;$month_i<=12;$month_i++)
			  				{
							?>	
						      <option value="<?php echo $month_i; ?>" <?php if($month_i==$month_number){echo 'selected';}?>><?php echo $month_show[$month_i];?></option>
							<?php 
			  				}
						    ?>
					    </select>			  		
					</div>
			  		<div class="form-group col-4">
			  			<select class="form-control" name="year_back" >
			  				<?php 
			  				$year_now=date('Y');
			  				$year_start=$year_now-10;
			  				$year_stop=$year_now+10;
			  				for($year_i=$year_start;$year_i<=$year_stop;$year_i++)
			  				{
							?>	
						      <option value="<?php echo $year_i; ?>" <?php if($year_i==$year_now){echo 'selected';}?>><?php echo $year_i+543;?></option>
							<?php 
			  				}
						    ?>
					    </select>
					    </div>
			  	</div>
		  	</div>
	  		<div class="form-group col-md-2 alert-warning">
		    <label >เวลา</label>
			    <div class="form-row">
			  		<div class="form-group col-6">
			  			<select class="form-control" name="h_back" >
			  				<?php 
			  				$H_now=date('H');
			  				for($H_i=1;$H_i<=24;$H_i++)
			  				{
							?>	
						      <option <?php if($H_i==16){echo 'selected';}?>><?php echo sprintf("%02d",$H_i);?></option>
							<?php 
			  				}
						    ?>
					    </select>			  		
					</div>
			  		<div class="form-group col-6">
			  			<select class="form-control" name="i_back" >
			  				<?php 
			  				$M_now=date('i');
			  				for($M_i=1;$M_i<=60;$M_i++)
			  				{
							?>	
						      <option <?php if($M_i==30){echo 'selected';}?>><?php echo sprintf("%02d",$M_i);?></option>
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

