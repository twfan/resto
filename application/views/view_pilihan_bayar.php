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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.css" media="screen">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.js"></script>
	

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
  	$(".perbesar").fancybox();
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
			<div class="col-md-12">
				<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
					<div class="col-md-12">
						<h3>Pilihan metode pembayaran</h3>
					</div>
					<div class="col-md-12 content_panel " style="min-height: 100%;">
			<div class="col-md-12">
				<div class="row">
					<ul class="nav nav-tabs">
					    <li class="active"><a data-toggle="tab" href="#transfer">Via Transfer</a></li>
					    <li><a data-toggle="tab" href="#saldo">Saldo</a></li>
					</ul>
				  	<div class="tab-content">
					    <div id="transfer" class="tab-pane fade in active">
					    	<?php echo form_open_multipart(base_url("utama/proses_bayar_upload/".$idpesanan), 'method="POST"') ?>
					    		<div class="row" style="margin-top:25px;">
						        	<div class="col-md-2"> Nama Rekening</div>
							        <div class="col-md-4">
							        	<div class="form-group">
							        		<input type="text" class="form-control" placeholder="Nama rekening yang digunakan"  name="namarekening" maxlength="35" value=""/>
							        	</div>
							        </div>
						        </div>
						        <div class="row">
						        	<div class="col-md-2"> Jumlah Transfer</div>
							        <div class="col-md-2">
							        	<div class="form-group">
							        		<input type="hidden" class="form-control" placeholder="Jumlah transfer"  name="jumlahtransfer" maxlength="35" value="<?php echo $total; ?>"/>
							        		<strong><?php echo $total; ?></strong>
							        		<!--  -->
							        	</div>
							        </div>
						        </div>
						        <div class="row">
						        	<div class="col-md-2">Bank yang digunakan</div>
							        <div class="col-md-2">
							        	<div class="form-group has-feedback">
											<select class="combobox form-control" name="bank" prompt="Bank">
												<option value="" disabled selected>Pilih bank</option>
												<option value="BCA">BCA</option>
												<option value="BRI">BRI</option>
												<option value="BNI">BNI</option>
												<option value="MANDIRI">MANDIRI</option>
												<option value="NIAGA">NIAGA</option>
												<option value="LAINNYA">LAINNYA</option>
											</select>
										</div>
							        </div>
						        </div>
						        <div class="row">
						        	<div class="col-md-2"> Bukti Transfer</div>
							        <div class="col-md-2">
							        	<div class="form-group">
							        		<input type="file" class="" name="userfile" size="20"/>
							        	</div>
							        </div>
						        </div>
						        <div class="row" style="margin-bottom:25px;">
						        	<div class="col-md-2"></div>
						        	<div class="col-md-2 ">
						        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Tambahkan</button>
						        	</div>
						        </div>
					    	 <?php echo form_close(); ?>
					    	
					    </div>
					    <div id="saldo" class="tab-pane fade">
					    	<?php echo form_open_multipart(base_url("owner/about_system_makanan"), 'method="POST"') ?>
					    		<div class="row" style="margin-top:25px;">
						        	<div class="col-md-2"> Saldo yang dimiliki</div>
							        <div class="col-md-4">
							        	<div class="form-group">
							        		<strong>0</strong>
							        	</div>
							        </div>
						        </div>
						        <div class="row" style="margin-bottom:25px;">
						        	<div class="col-md-2"></div>
						        	<div class="col-md-2 ">
						        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Gunakan Saldo</button>
						        	</div>
						        </div>
						        <?php echo form_close(); ?>
					    </div>
					    <div id="menu3" class="tab-pane fade">
					      <h3>Menu 3</h3>
					      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
					    </div>    
					</div>
				</div>	
			</div>
		</div>

				</div>
			</div>
		</div>
	   
	<?php echo form_close(); ?>
</div>

<div class="container">
	<div class="row" style="background-color:whte;">
		
	</div>
</div>
<!-- FOOTER -->
<!-- <div class="container-fluid" style="background-color:grey;">
	<div class="container" >
		<div class="row" >
			<div class="col-md-4 text-left"><h4>resto.com</h4></div>
			<div class="col-md-4 col-md-offset-4 text-right" ><h4>Footer</h4></div>
		</div>
	</div>
</div> -->
</body>
</html>