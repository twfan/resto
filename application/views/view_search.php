<!DOCTYPE html>
<html lang="en">
<head>
	<title>RESTO</title>
<?php 



 ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/combobox/css/bootstrap-combobox.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui-datepicker/jquery-ui.css">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui-datepicker/jquery-ui.js"></script>
	
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
<script type="text/javascript">
  $(document).ready(function(){

  	$( "#tanggal" ).datepicker({
  		dateFormat: "yy-mm-dd",
	  minDate: new Date(),
	  maxDate: "+1w"
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
	      <a class="navbar-brand" href="<?php echo base_url('utama/logged_in'); ?>">Resto.com</a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="<?= base_url('utama/pelanggan')?>">Hi, <?php echo $this->session->userdata('user_pelanggan'); ?></a></li>
	        <li><a href="<?= base_url('utama/logout')?>">Keluar</a></li>
	        
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>



<!-- END OF NAVBAR -->


<div class="container">


<!-- SLIDER -->
	<div style="color:red;font-style:italic;margin-top:10px;margin-bottom:25px;">	<?php echo $this->session->flashdata('pesanan_berhasil'); ?></div>
	

<br>
<br>


 
</div>
<!-- END OF CONTENT -->
<div class="container">
	<div class="row">
		<div class="col-md-3"> </div>
		<div class="col-md-9"> <h3><?php echo $this->session->flashdata('pesan'); ?></h3> </div>
	</div>
    <div class="row">
    	<div class="col-md-3">
    		<div class="row form search">
				<div class="container" style="background-color:white;margin-bottom:20px;width:auto;" >
						<div class="row">
							<div class="col-md-12 text-center" style=""><h3>Filter</h3></div>
						</div>
						<?php echo form_open(base_url('utama/result')); ?>
						<div class="row">
							<div class="col-md-12">Kota</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="checkbox" name="kota[]" value="JKT">JAKARTA </input><br>
									<input type="checkbox" name="kota[]" value="SBY">SURABAYA </input><br>
									<input type="checkbox" name="kota[]" value="MDN">MEDAN </input><br>
									<input type="checkbox" name="kota[]" value="BDG">BANDUNG </input><br>
									<input type="checkbox" name="kota[]" value="SMG">SEMARANG </input><br>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"></div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="checkbox" name="halal[]" value="1">Halal </input><br>
									<input type="checkbox" name="halal[]" value="0">Non-Halal </input><br>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">Tipe masakan</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="checkbox" name="masakan[]" value="seafood">Seafood</input><br>
									<input type="checkbox" name="masakan[]" value="chinese">Chinese food</input><br>
									<input type="checkbox" name="masakan[]" value="japanes">Japanese food</input><br>
									<input type="checkbox" name="masakan[]" value="local">Local food </input><br>
								</div>
							</div>
						</div>

						<!-- <div class="row">
							<div class="col-md-12" >
								<form action="<?php echo base_url('utama/proses_search');?>" method="POST">
									<div class="form-group has-feedback register ">
						                <input id="tanggal" readonly type="text" class="form-control " name="tanggal_acara"  placeholder="Tanggal" maxlength="10" name="tanggal" value="<?php echo set_value('tanggal'); ?>"/>
						                <i  id="test" class=" glyphicon glyphicon-calendar form-control-feedback"></i>        	
						            </div>
						             <div class="form-group has-feedback register">
										<select class="combobox form-control" name="jam_acara"style="" prompt="Jumlah kursi yang dipesan">
											
											<option value="" disabled selected>Jam acara</option>
											<option value="10">10.00 AM</option>
											<option value="11">11.00 AM</option>
											<option value="12">12.00 AM</option>
											<option value="13">13.00 PM</option>
											<option value="14">14.00 PM</option>
											<option value="15">15.00 PM</option>
											<option value="16">16.00 PM</option>
											<option value="17">17.00 PM</option>
											<option value="18">18.00 PM</option>
											<option value="19">19.00 PM</option>
											<option value="20">20.00 PM</option>
											<option value="21">21.00 PM</option>
										</select>
									</div>
									<div class="form-group has-feedback register">
										<select class="combobox form-control" name="jumlah_kursi" prompt="Jumlah kursi yang dipesan">
											<option value="" disabled selected>Jumlah kursi</option>

											
											<option value="2">2 Orang</option>
													<option value="3">3 Orang</option>
													<option value="4">4 Orang</option>
													<option value="5">5 Orang</option>
													<option value="6">6 Orang</option>
													<option value="7">7 Orang</option>
													<option value="8">8 Orang</option>
													<option value="9">9 Orang</option>
													<option value="10">10 Orang</option>
													<option value="11">11 Orang</option>
													<option value="12">12 Orang</option>
													<option value="13">13 Orang</option>
													<option value="14">14 Orang</option>
													<option value="15">15 Orang</option>
													<option value="16">16 Orang</option>
													<option value="17">17 Orang</option>
													<option value="18">18 Orang</option>
													<option value="19">19 Orang</option>
													<option value="20">20 Orang</option>
													<option value="pesta">Pesta besar</option>
											<option value="pesta">Pesta besar</option>
										</select>
									</div>
									<div class="form-group has-feedback register ">
						                <input   type="text" class="form-control " name="keyword"  placeholder="Cari dengan katakunci" maxlength="100" name="tanggal" value="<?php echo set_value('tanggal'); ?>"/>
						                <i  id="test" class=" glyphicon glyphicon-search form-control-feedback"></i>        	
						            </div>
									<div class="form-group has-feedback register ">
							            <button class="btn btn-large btn-block btn-success paling bawah" type="submit" name="daftar">Cari</button>      	
							        </div>
								</form>
								
					           
							</div>
							
							
							
						</div> -->
						
					<div class="form-group has-feedback register ">
							            <button class="btn btn-large btn-block btn-success paling bawah" type="submit" name="daftar">Cari</button>      	
							        </div>
					<?php echo form_close(); ?>
				</div>
				
			</div>
	</div>

    	<div class="col-md-9">
    		

	        <div class="list-group">
	        	
	        	<?php if(!empty($record_resto)): ?>
					<?php foreach ($record_resto as $row):?>
			    		<a href="<?php echo base_url('utama/home_resto/'). '/'.$row->kode_resto; ?>" class="list-group-item">
			                <div class="media col-md-3">
			                    <figure class="pull-left">
			                        <img class="media-object img-rounded img-responsive"  src="<?php echo $row->foto_resto; ?>" style="width:244px;height:174px;" >
			                    </figure>
			                </div>
			                <div class="col-md-6">
			                    <h4 class="list-group-item-heading"> <?php echo $row->nama_resto ?> </h4>
			                    <p class="list-group-item-text"><?php echo $row->alamat_resto ?></p>
			                </div>
			                <div class="col-md-3 text-center">
			                   <?php foreach ($record_vote as $row2) {?>
			                	<?php if($row->kode_resto==$row2->id_resto) {?>
			                		<h2> <?php echo $row2->total_vote	 ?> <small> votes </small></h2>
			                	<?php }?>
		                	<?php } ?>
			                    <button type="button" class="btn btn-primary btn-lg btn-block"> Pesan Sekarang </button>
			                    <!-- <div class="stars">
			                        <span class="glyphicon glyphicon-star"></span>
			                        <span class="glyphicon glyphicon-star"></span>
			                        <span class="glyphicon glyphicon-star"></span>
			                        <span class="glyphicon glyphicon-star"></span>
			                        <span class="glyphicon glyphicon-star-empty"></span>
			                    </div>
			                    <p> Average 4.5 <small> / </small> 5 </p> -->
			                </div>
			        	</a>
					<?php endforeach; ?>
				<?php endif; ?>
	        </div>
    	</div>
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