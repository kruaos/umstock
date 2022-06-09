	<link href="<?php echo base_url('/bootstrap/'); ?>/dist/css/bootstrap-datepicker.css" rel="stylesheet" />


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url('/bootstrap/'); ?>/dist/js/bootstrap-datepicker-custom.js"></script>
	<script src="<?php echo base_url('/bootstrap/'); ?>/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

	<script type="text/javascript" src="<?php echo base_url(''); ?>DataTables/datatables.min.js"></script>

	<script>
		$(document).ready(function() {
			var table = $('#example').DataTable({
				pageLength: 5,
				lengthMenu: [
					[5, 10, 20, -1],
					[5, 10, 20, 'Todos']
				],
				order: [
					[2, 'desc']
				]
			})
		});


	
	</script>

	<script>
		$(document).ready(function() {
			$('.datepicker').datepicker({
				format: 'dd/mm/yyyy',
				todayBtn: true,
				language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
				thaiyear: true //Set เป็นปี พ.ศ.
			}).datepicker("setDate", "0"); //กำหนดเป็นวันปัจุบัน
		});
	</script>



	<div class=" text-center" style="background-color:Orange;" style="margin-top:100px" id="non-printable">
		<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019 Version 1.1 (Demo)</p>
		<?php
		if ($this->session->userdata('userid') == 43) {
			print_r($this->session->userdata());
		}	?>
	</div>
	</body>

	</html>