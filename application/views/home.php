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
	      <a class="navbar-brand" href="#">Brand</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
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
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="utama/registerpelanggan">Register</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>



<!-- END OF NAVBAR -->


<div class="container">


<!-- SLIDER -->


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




	


<!-- END OF SLIDER -->



<div class="row">

</div>
<h2>Buat reservasi meja mu dengan mudah</h2>
<div class="row style-combobox" >
	<div class="col-md-3">
		<div class="form-group has-feedback">
			<select class="combobox" style="width:250px;height:50px;" prompt="Jumlah kursi yang dipesan">
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
		 	<!-- <i class="glyphicon glyphicon-chevron-down form-control-feedback"></i> -->
		</div>
		 
	</div>
	<div class="col-md-3">
		<select class="combobox" style="width:250px;height:50px;" prompt="Jumlah kursi yang dipesan">
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
</div>


















<!-- CONTENT -->


<div class="row" id="berita">
	<div class="col-md-6">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>

	<div class="col-md-4">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>

	<div class="col-md-2">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore.
	</div>
</div>


</div>
<!-- END OF CONTENT -->




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