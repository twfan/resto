<html>
<head>
	<title></title>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
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
		background-color: white;
		
		
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
		<div class="col-md-10  " > <h3 > <a href="<?= base_url('owner/dashboard_owner') ?>">Dashboard User Resto </a></h3></div>
		<a href="log_out"> <div class="col-md-2 sign-out"><h5>Sign Out  <span class="glyphicon glyphicon-log-out" ></span></h5></div></a>
	</div>
	<div class="row middle" style="background-color:#DADFE1;">
		<div class="col-md-2 panel_kiri " style="min-height: 100%;">
			<div class="row">
				<a href="<?= base_url('owner/cek_reservasi')?>"><div class="col-md-12 menu"><li >Lihat Reservasi</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/dashboard_owner')?>"><div class="col-md-12 menu"><li >Reservation</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/dashboard_about') ?>"><div class="col-md-12 menu"><li >About</li></div></a>
			</div>
		</div>
		<div class="col-md-10 content_panel " style="min-height: 100%;">
				<div class="col-md-12">
					<div class="row">
						<ul class="nav nav-tabs">
						    <li class="active"><a data-toggle="tab" href="#about">Resto Profile</a></li>
						    <li><a data-toggle="tab" href="#makanan">Menu Makanan</a></li>
						    <li><a data-toggle="tab" href="#foto">Fasilitas</a></li>
						</ul>
					  	<div class="tab-content">
						    <div id="about" class="tab-pane fade in active">
						        <h3></h3>
								
						        <form action="http://localhost/resto/owner/about_system" method="POST">
						        	<div class="row">
							        	<div class="col-md-2"> Nama Resto</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<input type="text" class="form-control" placeholder="Nama resto"  name="namaresto" maxlength="35" value=""/>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Foto Resto</div>
								        <div class="col-md-2">
								        	<div class="form-group">
								        		<input type="file" class="" name="userfile" size="20"/>
								        	</div>
								        </div>
								        <div class="col-md-2">
								        	<img src="<?php echo $detail->foto_resto;?>" style="height:200px;width:200px;">
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Alamat Resto</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<textarea class="form-control" rows="4" cols="74" name="alamatresto" value="" placeholder="Alamat terbaru restaurant"></textarea>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> No telfon Resto</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<input type="text" class="form-control" placeholder="Nomor telfon resto"  name="notelfonresto" maxlength="35" value=""/>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Jadwal Buka</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<textarea class="form-control" rows="4" cols="74" name="jadwal"  placeholder="Jadwal jam buka"></textarea>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Tipe sajian</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<textarea class="form-control" rows="4" cols="74" name="sajian"  placeholder="Sajian makanan yang disediakans"></textarea>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Kisaran Harga</div>
								        <div class="col-md-4">
								        	<div class="row">
								        		<div class="col-md-5">
									        		<div class="form-group">
										        		<input type="text" class="form-control" placeholder="Terendah"  name="terendah" maxlength="35" value=""/>
										        	</div>
									        	</div>
									        	<div class="col-md-1"> <h5>~</h5> </div>
									        	<div class="col-md-6">
									        		<div class="form-group">
										        		<input type="text" class="form-control" placeholder="Tertinggi"  name="tertinggi" maxlength="35" value=""/>
										        	</div>
									        	</div>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Metode Pembayaran</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<textarea class="form-control" rows="4" cols="74" name="pembayaran" placeholder="Metode Pembayaran"></textarea>
								        	</div>
								        </div>
							        </div>
							        
							        <div class="row">
							        	<div class="col-md-2"></div>
							        	<div class="col-md-2 ">
							        		<button class="btn btn-large btn btn-success center  " type="submit" name="input" >Simpan Data</button>
							        	</div>
							        </div>
							    </form>
							</div>
						    <div id="makanan" class="tab-pane fade">
						    	<h3 style="margin-bottom:15px;">Daftar makanan dan minuman</h3>
						    	<form action="http://localhost/resto/owner/about_system_makanan" method="POST">
						    		<div class="row">
							        	<div class="col-md-2"> Nama Makanan</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<input type="text" class="form-control" placeholder="Nama makanan atau minuman"  name="namamakanan" maxlength="35" value=""/>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Deskripsi makanan</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<textarea class="form-control" rows="4" cols="74" name="deskripsimakanan" value="" placeholder="Deskripsi makanan"></textarea>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Harga Makanan</div>
								        <div class="col-md-2">
								        	<div class="form-group">
								        		<input type="text" class="form-control" placeholder="Harga"  name="hargamakanan" maxlength="35" value=""/>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"></div>
							        	<div class="col-md-2 ">
							        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Tambahkan</button>
							        	</div>
							        </div>
						    	</form>
						    </div>
						    <div id="menu2" class="tab-pane fade">
						      <h3>Menu 2</h3>
						      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
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
</body>
</html>