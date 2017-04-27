<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datepicker/css/datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
	.paling_bawah{
		margin-bottom: 25px;
	}
	</style>
</head>
<body>
<script>
  $(document).ready(function(){
  
  	$('#register').click(function(){
  		var username = $("#username").val();
  		var password = $("#password").val();
  		var conf_password = $("#conf_password").val();
  		var nama_user = $("#nama_user").val();
  		var email = $("#email").val();
  		if(password==conf_password)
  		{
  			$.ajax({
	  			type:'post',
	  			dataType:'json',
	  			url:"<?php echo base_url('admin/proses_register')  ?>",
				data:{username:username,password:password,nama_user:nama_user,email:email},
				success:function(html)
				{
					swal({
							  title: "Id berhasil didaftar",
							  text: "Mohon verifikasi email yang telah didaftarkan.",
							  type: "success",
							  confirmButtonText: "Ok"
							},
							function(){
							  window.location.replace("<?php echo base_url('admin') ?>");
							});
					
				}
	  		});
  		}else
  		{
  			swal("Password tidak sama", "Kombinasi password dan konfirmasi password tidak sama", "error");
  		}
  		
  	});
  });
</script>
<div class="container ">
	<div class="col-md-6 col-md-offset-3">
		<h1 class="text-center"><a href="home">RESTO.COM</a></h1>
		<h3 class="text-center" ><strong>Pendaftaran user ID admin</strong></h3>
		
		<hr>
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
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Username"  id="username" value="<?php echo set_value('username'); ?>" maxlength="35"/>
			</div>
			<div class="col-md-6">
				<input type="password" class="form-control" placeholder="Password"  id="password" value="<?php echo set_value(''); ?>" maxlength="35"/>
			</div>
		</div>
		<div class="row" style="margin-top:10px;">
			<div class="col-md-6">
				<input type="password" class="form-control" placeholder="Konfirmasi Password"  id="conf_password" value="<?php echo set_value(''); ?>" maxlength="35"/>
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Nama User"  id="nama_user" value="<?php echo set_value('nama_user'); ?>" maxlength="35"/>
			</div>
		</div>
		<div class="row" style="margin-top:10px;">
			<div class="col-md-12">
				<input type="email" class="form-control" placeholder="Alamat email"  id="email" value="<?php echo set_value('email'); ?>"   maxlength="25"/>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button style='margin-top:15px;' class="btn btn-large btn-block btn-success paling_bawah" id="register" type="submit" name="daftar">Daftar</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>