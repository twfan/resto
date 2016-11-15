<html>
<head>
	<title></title>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<style type="text/css">

	.header{
		height: 60px;
		
		background-color: #ABB7B7;
		font-size: 20px;
	}
	.sign-out
	{
		font-size: 15px;
		padding-top: 10px;
		text-align: right;
	}

	.panel_kiri{
		
		height: 100%;
		background-color: #DADFE1;
	}
	.menu{
		height: 50px;
		position: relative;
		background-color:#D2D7D3;
		list-style-type: none;
		text-align: left;
		padding: 10px;
		padding-left: 25px;
		margin-right: 0px;
		padding-right: 0px;
		font-size: 18px;
		transition: all 0.3s;
		-moz-transition: all 0.3s;
		-webkit-transition: all 0.3s;
		-ms-transition: all 0.3s;
		-o-transition: all 0.3s;
	}
	.menu:hover{
		background-color: #BDC3C7 ;
	}
	a
	{
		text-decoration: none;
		font-color : black;
	}
	a:hover{
		color:white;
	}
	.content_panel{
		width: 100%;
		height:80%;
		background-color: white;
		margin-top: 15px;
		border-radius: 25px 50px;
		padding-top: 15px;
		padding-left: 15px;
		padding-right: 20px;
		padding-bottom: 20px;
	}


</style>
</head>
<body>
<div class="container-fluid wrapper" >
	<div class="row header">
		<div class="col-md-10  "> <h3>Dashboard User Resto</h3></div>
		<a href="log_out"> <div class="col-md-2 sign-out"><h5>Sign Out  <span class="glyphicon glyphicon-log-out" ></span></h5></div></a>
	</div>
	<div class="row" style="background-color:#F2F1EF;">
		<div class="col-md-2 panel_kiri">
			<div class="row">
				<a href=""><div class="col-md-12 menu"><li >Reservation</li></div></a>
			</div>
			<div class="row">
				<a href=""><div class="col-md-12 menu"><li >About</li></div></a>
			</div>
			<div class="row">
				<a href=""><div class="col-md-12 menu"><li >Photos</li></div></a>
			</div>
			<div class="row">
				<a href=""><div class="col-md-12 menu"><li >Menu</li></div></a>
			</div>
		</div>
		<div class="col-md-10">
			<div class="content_panel">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4">Selamat datang <?php echo $this->session->userdata('user'); ?></div>
						<!-- <div class="col-md-4" style="background-color:red">asdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasd</div>
						<div class="col-md-4" style="background-color:green">asdasdadasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasd</div>
						<div class="col-md-4" style="background-color:blue">asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasdasdasdsad asdasdasd asdasd</div> -->
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>