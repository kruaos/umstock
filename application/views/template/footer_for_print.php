	<link href="<?php echo base_url('/bootstrap/');?>/dist/css/bootstrap-datepicker.css" rel="stylesheet" />


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url('/bootstrap/');?>/dist/js/bootstrap-datepicker-custom.js"></script>
	<script src="<?php echo base_url('/bootstrap/');?>/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>


	<script>
	    $(document).ready(function () {
	        $('.datepicker').datepicker({
	            format: 'dd/mm/yyyy',
	            todayBtn: true,
	            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
	            thaiyear: true              //Set เป็นปี พ.ศ.
	        }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
	    });

	</script>

 <style type="text/css" media="screen">

* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.page {
  padding: 2.0cm;
  background: white;
  width: 30cm;
  height: 42.42cm;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}

.subpage {
  padding: 0cm;
  border: 0px;
  height: 256mm;
  outline: 2cm;
}

@page {
  size: A4;
  margin: 0;
}

@media print {
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}

</style>


	<div class=" text-center d-print-none" style="background-color:Orange;"  style="margin-top:100px" >
	<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019  Version 1.1 (Demo)</p>
	<?php 
	if ($this->session->userdata('userid')==43){
		print_r($this->session->userdata());
	}
	?>
	</div>
</body>
</html>