<div class="container ">
  <div class="row">
		<table class="table table-hover "  >
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">ชื่อ</th>
		      <th scope="col">ส่วนที่เข้าใช้</th>
		      <th scope="col">เวลา</th>
		    </tr>
		  </thead>
		  <tbody>
<?php 
	$num=1;
	$sql="SELECT * FROM log_member,tb_customer WHERE log_member.log_customer_id=tb_customer.cusid";
	foreach ($this->db->query($sql)->result() as $rs) {
		$fullname=$rs->fullname;
		$log_use_menu=$rs->log_use_menu;
		$log_timestamp=$rs->log_timestamp;
?>
		    <tr>
		      <th scope="row"><?php echo $num;?></th>
		      <td><?php echo $fullname;?></td>
		      <td><?php echo $log_use_menu;?></td>
		      <td><?php echo $log_timestamp;?></td>
		    </tr>
<?php
	$num++; 
	}
?>
		  </tbody>
		</table>

  </div>
</div>

