<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datepicker/css/datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/sweetalert/css/sweetalert2.css">

	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweetalert/js/sweetalert2.js"></script>
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<script>
  $( function() {

  	

  	
  	 $('#tanggal').datepicker({
        format: "yyyy-mm-dd",
        autoclose:true,
        maxDate: "now"
    });  	
  });
</script>
<div class="container" id="login">
	<h1 class="text-center"><a href="home">RESTO.COM</a></h1>
	<h3 class="text-center"><strong>Hallo Admin !</strong></h3>
	<!-- <p class="text-center"> Sudah mempunyai akun? Masuk <a href="">disini</a></p> -->
	<form action="<?php echo base_url('admin/login') ?>" method="POST">
		<div class="col-md-4 col-md-offset-4" >
			<?php
			if($this->session->flashdata('pesan')!=''){
			?>
			<div class="row">
				<?php echo $this->session->flashdata('pesan'); ?>
			</div>
			<?php
			}
			?>
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="email" class="form-control" placeholder="Username ID"  name="email_login" />
				    <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
	                <input type="password" class="form-control"  placeholder="Password" name="password_login"/>
	                <i class="glyphicon glyphicon-lock form-control-feedback"></i>
	            </div>
			</div>
			<div class="row"><button class="btn btn-large btn-block btn-success paling bawah" type="submit" name="masuk">Masuk ke Admin panel</button></div>
		</div>
	</form>
</div>
</body>
</html>