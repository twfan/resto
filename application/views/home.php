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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.css">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.min.js"></script>
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
<script type="text/javascript">
 

  $(document).ready(function(){
  	var base_url = $('.baseurl').text();
  	/*swal({
	  title: "Error!",
	  text: "Here's my error message!",
	  type: "error",
	  confirmButtonText: "Cool"
	});*/
    /*$('.combobox').combobox();*/
    $('#tanggal').datepicker({
        format: "dd-mm-yyyy",
        autoclose:true,
        minDate: new Date(),
	  maxDate: "+1w"
    });
    $('.tes').click(function(){
    	swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover this imaginary file!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  closeOnConfirm: false
		},
		function(){
			
		  	/*window.location.replace(base_url);*/
		  	alert(base_url);
		});
    });
    
  });
</script>

</head>

<body>


<!-- NAVBAR -->

	<nav class="navbar navbar-default" style="background-color: #D2D7D3;">
		<div class="baseurl hidden" ?><?php echo base_url('utama').'/' ?></div>
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

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <!-- <ul class="nav navbar-nav">
	        <li class=""><a href="#">Link <span class="sr-only">(current)</span></a></li>
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
	        <li><a href="<?= base_url('utama/login')?>">Login</a></li>
	        <li><a href="<?= base_url('utama/registerpelanggan')?>">Register</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>



<!-- END OF NAVBAR -->


<div class="container">


<!-- SLIDER -->
	<div style="color:red;font-style:italic;margin-top:10px;margin-bottom:25px;">	<?php echo $this->session->flashdata('pesanan_berhasil'); ?></div>
	<div style="color:red;font-style:italic;margin-top:10px;margin-bottom:25px;">	<?php echo $this->session->flashdata('berhasil_verifikasi'); ?></div>
	<div style="color:red;font-style:italic;margin-top:10px;margin-bottom:25px;">	<?php echo $this->session->flashdata('email_sent'); ?></div>
	<div class="row form search">
		<div class="container" style="background-color:white;margin-bottom:20px;">
				<div class="row">
					<div class="col-md-12" style=""><h3>Cari meja dan restauran mu sekarang</h3></div>
					<div class="col-md-12"><h5 style="font-style:italic;color:red;"><?php echo $this->session->flashdata('pesan'); ?> </h5> </div>
				</div>
				<form action="<?php echo base_url('utama/proses_search');?>" method="POST">
					<div class="row">
					<div class="col-md-2">
						<div class="form-group has-feedback register ">
			                <input id="tanggal" readonly type="text" class="form-control " name="tanggal_acara"  placeholder="Tanggal" maxlength="10" name="tanggal" value="<?php echo set_value('tanggal'); ?>"/>
			                <i  id="test" class=" glyphicon glyphicon-calendar form-control-feedback"></i>        	
			            </div>
					</div>
					<div class="col-md-2">
						<div class="form-group has-feedback register">
							<select class="combobox form-control" name="jam_acara" style="" prompt="Jumlah kursi yang dipesan">
								<!-- INI NANTI DIKASI PENGECEKKAN JAM BUKA  -->
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
					</div>
					<div class="col-md-2">
						<div class="form-group has-feedback register">
							
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
					<div class="col-md-4">
						<div class="form-group has-feedback register ">
			                <input   type="text" class="form-control " name="keyword"  placeholder="Cari dengan katakunci" maxlength="100" name="tanggal" value="<?php echo set_value('tanggal'); ?>"/>
			                <i  id="test" class=" glyphicon glyphicon-search form-control-feedback"></i>        	
			            </div>
					</div>
					<div class="col-md-2">
						<div class="form-group has-feedback register ">
			                <button class="btn btn-large btn-block btn-success paling bawah" type="submit" name="daftar">Cari</button>      	
			            </div>
					</div>
				</div>
				</form>
				
		</div>
	</div>
	<div class="row">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="<?php echo base_url(); ?>assets/img/banner/1.jpg" alt="Testing 1">
		      <div class="carousel-caption">
		        Gambar 1
		      </div>
		    </div>
		    <div class="item">
		      <img src="<?php echo base_url(); ?>assets/img/banner/2.jpg" alt="Testing 2">
		      <div class="carousel-caption">
		       Gambar 2
		      </div>
		    </div>
		    <div class="item">
		      <img src="<?php echo base_url(); ?>assets/img/banner/3.jpg" alt="Testing 3">
		      <div class="carousel-caption">
		      Gambar 3
		      </div>
		    </div>
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
	</div>

<br>
<br>


	


<!-- END OF SLIDER -->




<!-- <h2>Buat reservasi meja mu dengan mudah</h2>
<div class="row style-combobox" >
	<div class="col-md-3">
		<div class="form-group has-feedback">
			<select class="combobox form-control" style="width:250px;height:50px;" prompt="Jumlah kursi yang dipesan">
				<option value="" disabled selected>Jumlah kursi</option>
				<option value="1">1 Orang</option>
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
			<input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" maxlength="20" name="tanggal" style="width:250px;height:50px;"/>
		 	
		</div>
		 
	</div>
	<div class="col-md-3">
		<select class="combobox form-control" style="width:250px;height:50px;" prompt="Jumlah kursi yang dipesan">
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

	<div class="col-md-3">
		<button class="btn btn-block btn-success paling bawah" type="submit" name="cari" style="width:250px;height:50px;" >CARI</button>
	</div>
</div> -->


















<!-- CONTENT -->




 
</div>
<!-- END OF CONTENT -->
<div class="container">
    <div class="row">
        <h1 class="text-center">Vote for your favorite</h1>
        <div class="list-group">

        	<?php if(!empty($record_resto)): ?>
				<?php foreach ($record_resto as $row):?>
    				<!-- <tr>
    					<td><?php echo $row->nama_makanan; ?></td>
    					<td><?php echo $row->harga; ?></td>
    					<td><img src="<?php echo $row->foto_makanan; ?>" style="width:100px;height:100px;"></td>
    					<td><a href="<?php echo base_url('owner/edit_menu/'.$row->kode_menu) ?>">Edit</a> | <a href="<?php echo base_url('owner/hapus_makanan/'.$row->kode_menu) ?>">Hapus</a></td>
    				</tr> -->


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
		                    <!-- <h2> 14240 <small> votes </small></h2> -->
		                    <button type="button" class="btn btn-primary btn-lg btn-block"> Vote Now! </button>
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