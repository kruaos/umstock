<?php
?>
	<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- แทรกส่วนสัญลักษณต่างๆ  -->
    <script defer src="<?php echo base_url('bootstrap/all.js');?>"></script>
<!-- แทรกส่วนอักษร saraban      -->
    <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet">
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  
    <script src="<?php echo base_url('/bootstrap/');?>/dist/js/bootstrap-datepicker-custom.js"></script>
	  <script src="<?php echo base_url('/bootstrap/');?>/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script> 
    
     
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <!-- 
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.22/i18n/Thai.json"></script> 
  -->
  
    <script type="text/javascript">
            $(document).ready( function () {
                $('#table_id').DataTable({
                  "order": [[ 0, 'desc' ]]
                });
            } );
    </script>
  
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>

<div style="margin-top:60px">
