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

	
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.min.js"></script>


	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
	body{
		text-align: left;
	}
	.rating {
		unicode-bidi: bidi-override;
		direction: rtl;
	}
	.rating > span {
		display: inline-block;
		position: relative;
		width: 1.1em;
	}
	.rating > span:hover:before,
	.rating > span:hover ~ span:before {
		font-size : 20px;
		content: "\2605";
		position: absolute;
		color: yellow;
	}
	</style>

	
<script type="text/javascript">
  $(document).ready(function(){
    /*$('.combobox').combobox();*/
    var pgwSlideshow = $('.pgwSlideshow').pgwSlideshow();
    pgwSlideshow.reload({
	    maxHeight:400,
	    intervalDuration:5000
	});
    pgwSlideshow.startSlide();
    $('#tanggal').datepicker({
        startDate: "+1d"
    });


    $('.rating').find('span').each(function() {
		$(this).on('click', function() {
			$('.rating').find('span').css('color', 'black')
			$(this).css('color', 'yellow')
			$(this).nextAll().css('color', 'yellow')
			$('#star').val($(this).data('rating'))
		})
	})

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
	<?php if(!empty($record_resto)): ?>
		<?php foreach ($record_resto as $row):?>
			<div class="container">
			    <div class="fb-profile">
			        <img align="left" class="fb-image-lg" src="<?php echo $row->foto_resto ?>"  style="width:100%;height:350px;"alt="Profile image example"/>
			        <img align="left" class="fb-image-profile thumbnail" src="<?php echo $row->foto_resto ?>" alt="Profile image example"/>
			        <div class="fb-profile-text">
			            <h1><?php echo $row->nama_resto ?></h1>
			            <p><?php echo $row->alamat_resto ?></p>
			        </div>
			    </div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<div class="row" style="margin-top:25px;">
		<div class="col-md-8" >
			
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
					<div class="review-block">
						<div class="row">
							<div class="col-sm-3">
								<?php if(!empty($record_pelanggan)){ ?>
									<?php foreach ($record_pelanggan as $row) {?>
										<div class="review-block-name"><?php echo $row->nama_user ?></div>
									<?php } ?>
								<?php } ?>
							</div>
							<div class="col-sm-9">
								<div class="review-block-rate">
									<!-- <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
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
									</button> -->
									<div class="rating">
										<span style="font-size : 20px" data-rating="5">☆</span>
										<span style="font-size : 20px" data-rating="4">☆</span>
										<span style="font-size : 20px" data-rating="3">☆</span>
										<span style="font-size : 20px" data-rating="2">☆</span>
										<span style="font-size : 20px" data-rating="1">☆</span>
									</div>
									
								</div>
								<form action="<?php echo base_url('utama/simpan_review'); ?>" method="POST">
								<input type="hidden" name="rating" id="star">
								<?php if(!empty($record_resto)){ ?>
									<?php foreach ($record_resto as $row) { ?>
										<input type="hidden" name="koderesto" value="<?php echo $row->kode_resto; ?>"></input>
										<?php } ?>
								<?php } ?>
								<?php if(!empty($record_pelanggan)){ ?>
									<?php foreach ($record_pelanggan as $row) { ?>
										<input type="hidden" name="kodepelanggan" value="<?php echo $row->id_user; ?>"></input>
										<?php } ?>
								<?php } ?>
									<div class="review-block-title"><input type="text" class="form-control" placeholder="Judul Review"  name="judulreview" maxlength="100" value=""></div>
									<div class="review-block-description"><textarea class="form-control" rows="4" cols="74" name="isireview"  placeholder="Tuliskan komentar anda" maxlength="250"></textarea></div><br />
									<div class="review-block-description"><button class="btn btn-small btn-success paling bawah" type="submit" name="kirim">Kirim</button></div>
								</form>
							</div>
						</div>
						<hr/>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-3" style="margin-bottom:25px;background-color:white;border-radius:10px;">
			<?php if(!empty($record_resto)){ ?>
				<?php foreach ($record_resto as $row){?>
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