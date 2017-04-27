<!DOCTYPE html>
<html lang="en">
<head>
	<title>RESTO</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/combobox/css/bootstrap-combobox.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datepicker/css/datepicker.css">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<style type="text/css">
		/*.menu-kiri:hover{
			background-color: yellow;
		}*/

		.menu-active{
			background-color: #EEEEEE;
		}
	</style>
<script type="text/javascript">
  $(document).ready(function(){
    /*$('.combobox').combobox();*/
    $('#tanggal').datepicker({
        format: "dd-mm-yyyy",
        autoclose:true,
        maxDate: "now",
        startDate: "+1d"
    });  	
  });
</script>

</head>

<body>


<!-- NAVBAR -->

	<nav class="navbar navbar-default" style="background-color: #D2D7D3;">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?php echo base_url('utama/logged_in') ?>">Resto.com</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <!-- <ul class="nav navbar-nav">
	        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
	        <li><a href="#">Link</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">One more separated link</a></li>
	          </ul>
	        </li>
	      </ul> -->
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="<?= base_url('utama/pelanggan')?>">Hai, <?php echo $this->session->userdata('user_pelanggan'); ?></a></li>
	        <li><a href="<?= base_url('utama/logout')?>">Keluar</a></li>
	        
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
<div class="container-fluid" style="background-color:white;margin-bottom:20px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="margin-bottom:25px;"><h1>Hai, <?php echo $this->session->userdata('user_pelanggan');  ?></h1></div>
		</div>
	</div>
</div>
<div class="container">
    <div class="row">
    	<div class="col-md-2" style="margin-bottom:25px; margin-right:20px;">
    		<a href="<?php echo base_url('utama/pelanggan'); ?>">
    			<div class="row menu-kiri " style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Pesanan</div>
				</div>
    		</a>
    		<a href="<?php echo base_url('utama/pelanggan_data_diri'); ?> ">
    			<div class="row menu-kiri menu-active" style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Data diri</div>
				</div>
    		</a>
    		<a href="<?php echo base_url('utama/top_up_saldo'); ?> ">
    			<div class="row menu-kiri  " style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Pembayaran</div>
				</div>
    		</a>
		</div>
		<?php if(!empty($record)){ ?>
			<?php foreach ($record as $row) {?>
				<form action="<?php echo base_url('utama/update_data_diri'); ?>" method="POST">
				<div class="col-md-8"  >
					<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
						<div class="col-md-12">
							<div style="color:red;font-style:italic;margin-top:10px;">	<?php echo $this->session->flashdata('email_kembar'); ?>
							<?php echo $this->session->flashdata('berhasil'); ?>
							<?php echo $this->session->flashdata('password_tidak_kembar'); ?></div>
							
							<h3>Informasi data diri </h3>
							<hr/>
						</div>
						<div class="col-md-12"><h4>Nama User</h4></div>
				        <div class="col-md-12">
				        	<div class="form-group">
				        		<input type="text" class="form-control" placeholder="Nama user"  name="namauser" maxlength="35" value="<?php echo $row->nama_user; ?>"/>
				        	</div>
				        </div>
				        <div class="col-md-6"><h4>No Handphone</h4></div>
				        <div class="col-md-6"><h4>Email</h4></div>
				        <div class="col-md-6">
				        	<div class="form-group">
				        		<input type="text" class="form-control" placeholder="Nomor handphone"  name="nohp" maxlength="35" value="<?php echo $row->no_handphone; ?>"/>
				        	</div>
				        </div>
				        <div class="col-md-6">
				        	<div class="form-group">
				        		<input type="text" class="form-control" placeholder="Email"  name="email" maxlength="35" value="<?php echo $row->email; ?>"/>
				        	</div>
				        </div>
				        
				        <div class="col-md-12"><hr/><h3>Password</h3>
				        </div>
				 		<div class="col-md-12"><h4>Password</h4></div>
				        <div class="col-md-12">
				        	<div class="form-group">
				        		<input type="password" class="form-control" placeholder="Password"  name="password" maxlength="35" value=""/>
				        	</div>
				        </div>
				        <div class="col-md-12"><h4>Konfirmasi Password</h4></div>
				        <div class="col-md-12" style="margin-bottom:25px;">
				        	<div class="form-group">
				        		<input type="password" class="form-control" placeholder="Konfirmasi Password"  name="confpassword" maxlength="35" value=""/>
				        	</div>
				        </div>
					</div>
					<div class="row">
						<button class="btn btn-small  btn-success" type="submit" name="simpan" style="margin-bottom:25px;width:200px;height:50px;">Simpan perubahan</button>
					</div>
				</div>
			</form>
			<?php } ?>
		<?php }else{ ?>
		
			<form action="<?php echo base_url('owner/update_data_diri'); ?>" method="POST">
				<div class="col-md-8"  >
					<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
						<div class="col-md-12">
							<h3>Informasi data diri</h3>
							<hr/>
						</div>
						<div class="col-md-12"><h4>Nama User</h4></div>
				        <div class="col-md-12">
				        	<div class="form-group">
				        		<input type="text" class="form-control" placeholder="Nama user"  name="namauser" maxlength="35" value=""/>
				        	</div>
				        </div>
				        <div class="col-md-6"><h4>No Handphone</h4></div>
				        <div class="col-md-6"><h4>Email</h4></div>
				        <div class="col-md-6">
				        	<div class="form-group">
				        		<input type="text" class="form-control" placeholder="Nomor handphone"  name="nohp" maxlength="35" value=""/>
				        	</div>
				        </div>
				        <div class="col-md-6">
				        	<div class="form-group">
				        		<input type="text" class="form-control" placeholder="Email"  name="email" maxlength="35" value=""/>
				        	</div>
				        </div>
				        
				        <div class="col-md-12"><hr/><h3>Password</h3>
				        </div>
				 		<div class="col-md-12"><h4>Password</h4></div>
				        <div class="col-md-12">
				        	<div class="form-group">
				        		<input type="password" class="form-control" placeholder="Password"  name="password" maxlength="35" value=""/>
				        	</div>
				        </div>
				        <div class="col-md-12"><h4>Konfirmasi Password</h4></div>
				        <div class="col-md-12" style="margin-bottom:25px;">
				        	<div class="form-group">
				        		<input type="password" class="form-control" placeholder="Konfirmasi Password"  name="confpassword" maxlength="35" value=""/>
				        	</div>
				        </div>
					</div>
					<div class="row">
						<button class="btn btn-small  btn-success" type="submit" name="simpan" style="margin-bottom:25px;width:200px;height:50px;">Simpan perubahan</button>
					</div>
				</div>
			</form>
		<?php } ?>
    </div>
</div>



<!-- FOOTER -->
<div class="container-fluid" style="background-color:grey;">
	<div class="container" >
		<div class="row" >
			<div class="col-md-4 text-left"><h4>resto.com</h4></div>
			<div class="col-md-4 col-md-offset-4 text-right" ><h4>Footer</h4></div>
		</div>
	</div>
</div>
</body>
</html>