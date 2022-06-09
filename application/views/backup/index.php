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
  <style>  .fakeimg {      height: 200px;     background: #aaa;  }  </style>
</head>
<body>
<?php 
  error_reporting(~E_NOTICE);

    if($chkmain==null){
        $jumpto="../";
    }else{
        $jumpto="";
    }

?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
 <h3 class="text-muted">UMStock</h3>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  </div>  
</nav>
<div class="text-center" style="margin-bottom:0">


</div>

<div class="container-fluid " style="margin-top:30px">
<div class="row">
<div class="text-center col-md-8" >
    <h1  class="col-12" >ระบบบริหารพัสดุสำนักงานเทศบาลตำบลอุโมงค์</h1>

    <img src="picture\informe.png" class="mx-auto col-6  ">

    </div>

  <div class="col-md-3"  >
	<FORM METHOD="POST" ACTION="member\chkmember.php" >
    <div class="form-group">
      <label for="email">ชื่อเข้าใช้ :</label>
      <INPUT NAME="user_login" TYPE="text" class="form-control" id="name" placeholder="ลงชื่อผู้ใช้"  >
    </div>
    <div class="form-group">
      <label for="pwd">รหัสผ่าน : </label>
      <input type="password" class="form-control" id="pwd" placeholder="กรอกรหัสผ่าน" name="pass_login" >
    </div>
    <button type="submit" class="btn btn-primary  btn-block" >เข้าสู่ระบบ </button>
  </form>
  <br>
  <a href="member\register.php" class="btn btn-danger btn-block" >ลงทะเบียน</a>



<div class="col-md-4">
</div>


  </div>
</div>

<div class=" text-center" style="background-color:Orange;"  style="margin-bottom:0">
<p>© สำนักงานเทศบาลตำบลอุโมงค์ 2019  Version 0.1 (Demo)</p>
</div>
</body>
</html>