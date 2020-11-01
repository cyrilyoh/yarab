<!DOCTYPE html>
<html>
<head>
	<title>Yarab</title>
	<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
  <script src="<?php echo base_url('bootstrap/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
</head>
<body>
	<div class="col-md-4" style="margin: 50px auto;">
<div class="card">
	<form method="post" action="<?php echo base_url('welcome/login');?>">
  <div class="card-header">Login</div>
  <div class="card-body">
  	<b class="text-danger"><?php echo validation_errors();?></b>
  	<b class="text-danger"><?php echo $this->session->flashdata('validation'); ?></b>
  	<b class="text-success"><?php echo $this->session->flashdata('success'); ?></b>
  	<div class="form-group">
  		<input type="email" name="email" class="form-control" placeholder="Email">
  	</div>
  	<div class="form-group">
  		<input type="password" name="password" class="form-control" placeholder="Password">
  	</div>
  </div>
  <div class="card-footer">
  <input type="submit" name="submit" value="Login" class="btn btn-primary form-control">
  <br><br>
  <a href="<?php echo base_url('welcome/register');?>">Register Now</a>
</div>
</form>
</div>
</div>
</body>
</html>