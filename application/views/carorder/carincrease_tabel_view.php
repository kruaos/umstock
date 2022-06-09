<div class="container">
  <div class="row">
<?php 
	function show_fullday($showdate){
		$month_name=array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤษจิกายน','ธันวาคม');
		$Y=substr($showdate,0,4)+543;
		$m=intval(substr($showdate,5,2));
		$d=substr($showdate,8,2);
		return $d." ".$month_name[$m]." ".$Y;
	}
?>
	<table class="table table-hover table-sm">
  	<thead>
	    <tr>
		    <th width="50">#</th>
		    <th width="150">หมายเลขทะเบียน</th>
		    <th width="120">ยี่ห้อรถยนต์</th>
		    <th width="200">ผู้รับผิดชอบ</th>
		    <th width="100">วันที่ได้มาซึ่งกรรมสิทธิ์</th>
		    <th width="100">กม./ลิตร</th>
		    <th >หมายเหตุ</th>

	    </tr>
  	</thead>
	<tbody>
		<?php 
		$num=1;
		foreach ($carmember as $cm)
		{
		?>
	    <tr>
		    <th scope="row"><?php echo $num; $num++?></th>
		    <td><?php echo $cm->car_member_display;?></td>
		    <td><?php echo $cm->car_member_brand;?></td>
		    <td>
		    <?php 
		    $query=$this->customer_main_model->customer_show_detail($cm->car_member_cusID);
		   	foreach ($query as $rs) {
		   		echo $rs->fullname;
		   	}
		    ?></td>
		    <td><?php 
		    $car_member_date_ownership=$cm->car_member_date_ownership;
		    echo $this->showdatetime_thai->show_fullday($car_member_date_ownership);
		    ?></td>
		    <td><?php echo $cm->car_member_oil_use;?></td>
			<td> 
		    	<div class="btn-group col-12" >
					<a href="<?php echo site_url('/carorder/carincreasedel/'.$cm->car_member_id);?>" class="btn btn-danger btn-sm">ลบ</a>
					<a href="<?php echo site_url('/carorder/carincreaseedit/'.$cm->car_member_id);?>" class="btn btn-warning btn-sm ">แก้ไข</a>
				</div>
			</td>
	    </tr>
		<?php
		}
		?>
	  </tbody>
	</table>

  </div>
</div>

