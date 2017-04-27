<!DOCTYPE html>
<html lang="en">
<head>
	<title>RESTO</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/reviewblock/reviewblock.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/combobox/css/bootstrap-combobox.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datepicker/css/datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui-datepicker/jquery-ui.css">

	
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui-datepicker/jquery-ui.js"></script>


	<meta name="viewport" content="width=device-width, initial-scale=1">
	

	
<script type="text/javascript">
  $(document).ready(function(){
    /*$('.combobox').combobox();*/
   $('html, body').scrollTop($('.nama').offset().top);
    


    var pgwSlideshow = $('.pgwSlideshow').pgwSlideshow();
    pgwSlideshow.reload({
	    maxHeight:400,
	    intervalDuration:5000
	});
    pgwSlideshow.startSlide();
   
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
	      <a class="navbar-brand" href="<?php echo base_url('utama/logged_in') ?>">Resto.com</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="<?= base_url('utama/pelanggan')?>">Hi, <?php echo $this->session->userdata('user_pelanggan'); ?></a></li>
	        <li><a href="<?= base_url('utama/logout')?>">Keluar</a></li>
	        
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

<div class="container" >
	<div style="color:red;font-style:italic;margin-bottom:25px;">	<?php echo $this->session->flashdata('terima_kasih'); ?></div>
	<?php if(!empty($record_resto)): ?>
		<?php foreach ($record_resto as $row):?>
			<div class="container ">
			    <div class="fb-profile">
			        <img align="left" class="fb-image-lg" src="<?php echo $row->foto_resto ?>"  style="width:100%;height:315px;"alt="Profile image example"/>
			        <img align="left" class="fb-image-profile thumbnail" src="<?php echo $row->foto_resto ?>" alt="Profile image example"/>
			        <div class="fb-profile-text">
			            <h1 class="nama"><?php echo $row->nama_resto ?></h1>
			            <p><?php echo $row->alamat_resto ?></p>
			        </div>
			    </div>
			</div> 
	<div class="row testing" style="margin-top:25px;">
		
		<div class="col-md-8" style="margin-left:20px;" >
			<div class="row" style="background-color:white;border-radius:10px;">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4 pesan"><h1>Pesan meja</h1></div>
					</div>
					<div class="row">
						<form action="<?php echo base_url('utama/pesan_meja') . '/'.$row->kode_resto;?>" method="POST">
		<?php endforeach; ?>
	<?php endif; ?>
							<div class="col-md-12">
								<div class="row style-combobox" >
									<div class="col-md-3">
										<div class="form-group has-feedback">
											<select class="combobox form-control" name="jumlah_kursi" prompt="Jumlah kursi yang dipesan">
												<option value="" disabled selected>Jumlah kursi</option>

												<!-- DIBERI BATAS SESUAI KAPASITAS YANG DISETTING -->
											
												
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
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group has-feedback">
											<input id="tanggal" readonly type="text" class="form-control " name="tanggal"  placeholder="Tanggal" maxlength="10" name="tanggal" value="<?php echo set_value('tanggal'); ?>"/>
										</div>
										 
									</div>
									<div class="col-md-3">
										<select class="combobox form-control"  name="jam_acara" prompt="Jam acara berlangsung">
											<option value="" disabled selected>Jam acara</option>
											<option value="10.00 AM">10.00 AM</option>
											<option value="11.00 AM">11.00 AM</option>
											<option value="12.00 AM">12.00 AM</option>
											<option value="13.00 PM">13.00 PM</option>
											<option value="14.00 PM">14.00 PM</option>
											<option value="15.00 PM">15.00 PM</option>
											<option value="16.00 PM">16.00 PM</option>
											<option value="17.00 PM">17.00 PM</option>
											<option value="18.00 PM">18.00 PM</option>
											<option value="19.00 PM">19.00 PM</option>
											<option value="20.00 PM">20.00 PM</option>
											<option value="21.00 PM">21.00 PM</option>
										</select>
									</div>

									<div class="col-md-3">
										<button class="btn btn-block btn-success paling bawah" type="submit" name="cari"  >Pesan Meja</button>
									</div>
								</div>
							</div>
						</form>
					</div>	
				</div>
			</div>
			<div class="row" style="background-color:white;margin-top:10px;margin-bottom:10px;border-radius:10px;">
				
					<?php if(!empty($record_foto)){?>
					<ul class="pgwSlideshow">
						<?php foreach ($record_foto as $row2):?>
						
							<li><img src="<?php echo $row2->path_foto ?>"></li>
						
						<?php endforeach; ?>
						</ul>
					<?php }else{?>
					<ul class="pgwSlideshow">
							<li><img src="http://lorempixel.com/400/200/Dummy-Text/"></li>
							<li><img src="http://lorempixel.com/400/200/Dummy-Text/"></li>
							<li><img src="http://lorempixel.com/400/200/Dummy-Text/"></li>
							<li><img src="http://lorempixel.com/400/200/Dummy-Text/"></li>
							<li><img src="http://lorempixel.com/400/200/Dummy-Text/"></li>
						</ul>
					<?php } ?>
				
			</div>
			<div class="row" style="background-color:white;border-radius:10px;margin-bottom:25px;">
				<div class="col-md-12"><h1>Review Pelanggan</h1></div>
				<hr/>
				<div class="col-md-12">
					<?php if(!empty($record_review)){ ?>
						<?php foreach ($record_review as $row) {?>
							<div class="review-block">
								<div class="row">
									<div class="col-sm-3">
										<div class="review-block-name"><?php echo $row->nama_user; ?></div>
										<div class="review-block-date"><?php echo $row->tanggal_review ?><br/></div>
									</div>
									<div class="col-sm-9">
										<div class="review-block-rate">
											<?php if( $row->rating =="1"){ ?>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
											<?php }elseif($row->rating=="2"){ ?>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
											<?php }elseif($row->rating=="3"){ ?>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
											<?php }elseif($row->rating=="4") {?>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
											<?php }else{ ?>
												<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning  btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning  btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning  btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
												</button>
												<button type="button" class="btn btn-warning  btn-xs" aria-label="Left Align">
												  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
											<?php } ?>
										</div>
										<div class="review-block-title"><?php echo $row->judul_review; ?></div>
										<div class="review-block-description"><?php echo $row->review_pelanggan; ?></div>
									</div>
								</div>
								<hr/>
							</div>
						<?php } ?>
					<?php }else{ ?>
					<div class="review-block">
						Belum ada review dari pelanggan.
						
					</div>
					<?php } ?>
					<!-- <div class="review-block">
						<div class="row">
							<div class="col-sm-3">
								<img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
								<div class="review-block-name"><a href="#">nktailor</a></div>
								<div class="review-block-date">January 29, 2016<br/>1 day ago</div>
							</div>
							<div class="col-sm-9">
								<div class="review-block-rate">
									<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
									  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
									<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
									  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
									<button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
									  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
									<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
									  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
									<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
									  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
								</div>
								<div class="review-block-title">this was nice in buy</div>
								<div class="review-block-description">this was nice in buy. this was nice in buy. this was nice in buy. this was nice in buy this was nice in buy this was nice in buy this was nice in buy this was nice in buy</div>
							</div>
						</div>
						<hr/>
					</div> -->
				</div>
			</div>
		</div>
		
		<div class="col-md-3" style="margin-left:10px;margin-bottom:25px;background-color:white;border-radius:10px;">
			<?php if(!empty($record_resto)){ ?>
				<?php foreach ($record_resto as $row) {?>
					<div class="row" style="padding-bottom:20px;padding-top:20px;">
						<div class="col-md-6">No telfon</div><div class="col-md-6"><?php echo $row->no_telfon; ?></div>
					</div>
					<div class="row" style="padding-bottom:20px;">
						<div class="col-md-6">Jadwal buka</div><div class="col-md-6"><?php echo $row->jadwal_buka; ?></div>
					</div>
					<div class="row" style="padding-bottom:20px;">
						<div class="col-md-6">Tipe Sajian</div><div class="col-md-6"><?php echo $row->tipe_sajian; ?></div>
					</div>
					<div class="row" style="padding-bottom:20px;">
						<div class="col-md-6">Kisaran harga</div><div class="col-md-6"><?php echo $row->harga_terendah; echo " - "; echo $row->harga_tertinggi?></div>
					</div>
					<div class="row" style="padding-bottom:20px;">
						<div class="col-md-6">Pembayaran</div><div class="col-md-6"><?php echo $row->metode_pembayaran; ?></div>
					</div>
				<?php } ?>
			<?php } ?>
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











<!-- CARA PENGGUNAAN PGWSLIDESHOW -->
<!-- http://pgwjs.com/pgwslideshow/ -->
<!-- IMPORTNYA
	ditambahi echo di belakang base url;
	<script type="text/javascript" src="<?php  base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script src="<?php  base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.js"></script>
	<link rel="stylesheet" href="<?php  base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.css"> -->
<!-- JAVASCRIPT -->
  <!-- 
  $(document).ready(function(){
  	$('.pgwSlideshow').pgwslideshow();
  }); 
-->
<!-- HTML -->
<!-- <ul class="pgwSlideshow">
    <li><img src="san-francisco.jpg" alt="San Francisco, USA" data-description="Golden Gate Bridge"></li>
    <li><img src="rio.jpg" alt="Rio de Janeiro, Brazil"></li>
    <li><img src="london_mini.jpg" alt="" data-large-src="london.jpg"></li>
    <li><img src="new-york.jpg" alt=""></li>
    <li><img src="new-delhi.jpg" alt=""></li>
    <li><img src="paris.jpg" alt=""></li>
    <li><img src="sydney.jpg" alt=""></li>
    <li><img src="tokyo.jpg" alt=""></li>
    <li><img src="honk-kong.jpg" alt=""></li>
    <li><img src="dakar.jpg" alt=""></li>
    <li><img src="toronto.jpg" alt=""></li>
    <li>
        <a href="http://en.wikipedia.org/wiki/Monaco" target="_blank">
            <img src="monaco.jpg" alt="Monaco">
        </a>
    </li>
</ul> -->
<!-- CARA PENGGUNAAN PGWSLIDESHOW -->