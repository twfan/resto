<html>
<head>
	<title></title>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/form/chosen.css">
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>assets/plugin/form/chosen.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#fmasakan").chosen();
});
</script>
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
				<a href="<?= base_url('owner/laporan') ?>"><div class="col-md-12 menu"><li >Laporan</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/dashboard_owner')?>"><div class="col-md-12 menu"><li >Reservation</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/dashboard_about') ?>"><div class="col-md-12 menu"><li >About</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/upgrade_akun') ?>"><div class="col-md-12 menu"><li >Upgrade Akun</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/pemasukan') ?>"><div class="col-md-12 menu"><li >Pemasukan Resto </li></div></a>
			</div>
		</div>
		<div class="col-md-10 content_panel " style="min-height: 100%;">
				<div class="col-md-12">
					<div class="row">
						<ul class="nav nav-tabs">
						    <li class="active"><a data-toggle="tab" href="#about">Resto Profile</a></li>
						    <li><a data-toggle="tab" href="#makanan">Menu Makanan</a></li>
						    <li><a data-toggle="tab" href="#foto">Foto Restauran</a></li>
						    <?php if($status_upgrade==1){?>
						    	 <li><a data-toggle="tab" href="#iklan">Iklan Restauran</a></li>
						    <?php } ?>
						</ul>
					  	<div class="tab-content">
						    <div id="about" class="tab-pane fade in active">
						    	<?php if($this->session->flashdata('pesan')==''){ ?>
						    	
						    	<?php }elseif($this->session->flashdata('pesan')=='1'){ ?>
						    	<div class="alert alert-success" style="margin-top:10px;">
								  <strong>Simpan data berhasil!</strong> Data berhasil disimpan.
								</div>
						    	<?php }elseif($this->session->flashdata('pesan')=='2'){ ?>
						    	<div class="alert alert-danger" style="margin-top:10px;">
								  <strong>Simpan foto gagal!</strong> Foto harus dibawah 1024kb dan berdimensi kurang dari 1000x1000.
								</div>
						    	<?php }elseif($this->session->flashdata('pesan')=='3'){ ?>
						    	<div class="alert alert-danger" style="margin-top:10px;">
								  <strong>Simpan foto iklan gagal!</strong> Foto harus dibawah 2500kb dan berdimensi kurang dari 1500x600.
								</div>
						    	<?php }?>
						    	

						    	
						        <h3 style="margin-bottom:15px;">Data Resto</h3>
									<?php

						        		 foreach($record as $detail){

						        	?>
						        <?php echo form_open_multipart(base_url("owner/about_system"), 'method="POST"') ?>
						        	<div class="row">
							        	<div class="col-md-2"> Nama Resto</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<input type="text" class="form-control" placeholder="Nama resto"  name="namaresto" maxlength="35" value="<?php echo $detail->nama_resto;?>"/>
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
								        
							        </div>
							        <div class="row">
							        	<div class="col-md-2"></div>
							        	<div class="col-md-2">
								        	<img class="perbesar" src="<?php echo $detail->foto_resto;?>" style="height:200px;width:200px;margin-bottom:10px;">
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Alamat Resto</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<textarea class="form-control" rows="4" cols="74" name="alamatresto" value="" placeholder="Alamat terbaru restaurant"><?php echo $detail->alamat_resto; ?></textarea>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Kota Resto</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<select class="combobox form-control" name="kota" style="" prompt="">
												<option value="" disabled selected>Kota</option>
												<option value="JKT" <?= $detail->kota=='JKT' ?'selected="selected"':''; ?> >JAKARTA</option>
												<option value="SBY" <?= $detail->kota=='SBY' ?'selected="selected"':''; ?>>SURABAYA</option>
												<option value="MDN" <?= $detail->kota=='MDN' ?'selected="selected"':''; ?>>MEDAN</option>
												<option value="BDG" <?= $detail->kota=='BDG' ?'selected="selected"':''; ?>>BANDUNG</option>
												<option value="SMG" <?= $detail->kota=='SMG' ?'selected="selected"':''; ?>>SEMARANG</option>
											</select>
								        	</div>
								        	
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> No telfon Resto</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<input type="text" class="form-control" placeholder="Nomor telfon resto"  name="notelfonresto" maxlength="35" value="<?php echo $detail->no_telfon; ?>"/>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Jadwal Buka</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<textarea class="form-control" rows="4" cols="74" name="jadwal"  placeholder="Jadwal jam buka"><?php echo nl2br($detail->jadwal_buka);?></textarea>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Tipe sajian</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<?= form_multiselect('masakan[]',$opt,$selected_opt,array('class'=>'form-control chosen-select col-md-12','data-placeholder'=>'Tipe masakan', 'id'=>'fmasakan')); ?>
								        	<!-- 	<select id='fmasakan' multiple class="form-control chosen-select col-md-12"  name="masakan[]" data-placeholder="Tipe masakan">
								        		
								        		</select> -->
								        	</div>
								        </div>
							        </div>
							         <div class="row">
							        	<div class="col-md-2"> Halal</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								      
								        			<input type="radio" name="halal" value="1" checked=""> Ya</input>
								        	
								        			<input type="radio" name="halal" value="0" > Tidak</input>
								        	
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Kisaran Harga</div>
								        <div class="col-md-4">
								        	<div class="row">
								        		<div class="col-md-5">
									        		<div class="form-group">
										        		<input type="text" class="form-control" placeholder="Terendah"  name="terendah" maxlength="35" value="<?php echo $detail->harga_terendah; ?>"/>
										        	</div>
									        	</div>
									        	<div class="col-md-1"> <h5>~</h5> </div>
									        	<div class="col-md-5">
									        		<div class="form-group">
										        		<input type="text" class="form-control" placeholder="Tertinggi"  name="tertinggi" maxlength="35" value="<?php echo $detail->harga_tertinggi; ?>"/>
										        	</div>
									        	</div>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Metode Pembayaran</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<textarea class="form-control" rows="4" cols="74" name="pembayaran" placeholder="Metode Pembayaran"><?php echo $detail->metode_pembayaran; ?></textarea>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Biaya 1 Kursi</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<div class="row">
								        			<div class="col-md-4"><input type="number" class="form-control"   name="biayakursi" maxlength="35" value="<?php echo $detail->biaya_kursi; ?>"/></div>
								        		</div>
								        	</div>
								        </div>
							        </div>
							        
							        <div class="row">
							        	<div class="col-md-2"> Notifikasi</div>
								        <div class="col-md-4">
								        	<div class="form-group">
								        		<?php if($detail->sms==1){ ?>
								        			<input type="checkbox" name="sms" value="1" checked=""> SMS</input>
								        		<?php }else{ ?>
								        			<input type="checkbox" name="sms" value="1" > SMS</input>
								        		<?php } ?>
								     			
								        	</div>
								        	<div class="form-group">
								        		<?php if($detail->email==1){ ?>
								        			<input type="checkbox" name="email" value="1" checked=""> Email</input>
								        		<?php }else{ ?>
								        			<input type="checkbox" name="email" value="1" > Email</input>
								        		<?php } ?>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"></div>
							        	<div class="col-md-2 ">
							        		<button class="btn btn-large btn btn-success center  " type="submit" name="input" >Simpan Data</button>
							        	</div>
							        </div>
							   <?php echo form_close(); ?>
							        <?php } ?>
							</div>
						    <div id="makanan" class="tab-pane fade">
						    	<h3 style="margin-bottom:15px;">Daftar makanan dan minuman</h3>
						    	<?php echo form_open_multipart(base_url("owner/about_system_makanan"), 'method="POST"') ?>
						    	
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
								        		<input type="number" class="form-control" placeholder="Harga"  name="hargamakanan" maxlength="35" value=""/>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"> Gambar Makanan</div>
								        <div class="col-md-2">
								        	<div class="form-group">
								        		<input type="file" class="" name="userfile" size="20"/>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"></div>
							        	<div class="col-md-2 ">
							        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Tambahkan</button>
							        	</div>
							        </div>
						    	 <?php echo form_close(); ?>
						    	<div class="table-responsive">
						    		<table class="table">
						    			<thead>
						    				<tr>
						    					<th>Nama Makanan</th>
						    					<th>Harga</th>
						    					<th>Foto</th>
						    					<th>Aksi</th>
						    				</tr>	
						    			</thead>
						    			<tbody>
						    			<?php if(!empty($record_menu)): ?>
						    					<?php foreach ($record_menu as $row):?>
								    				<tr>
								    					<td><?php echo $row->nama_makanan; ?></td>
								    					<td><?php echo $row->harga; ?></td>
								    					<td><img src="<?php echo $row->foto_makanan; ?>" style="width:100px;height:100px;"></td>
								    					<td><a href="<?php echo base_url('owner/edit_menu/'.$row->kode_menu) ?>">Edit</a> | <a href="<?php echo base_url('owner/hapus_makanan/'.$row->kode_menu) ?>">Hapus</a></td>
								    				</tr>
						    					<?php endforeach; ?>
						    				<?php endif; ?>
						    			</tbody>

						    		</table>
						    	</div>
						    </div>
						    <div id="foto" class="tab-pane fade">
						    	<h3 style="margin-bottom:15px;">Kumpulan foto Resto (Max 10 foto)</h3>
						    	<?php echo form_open_multipart(base_url("owner/about_system_foto"), 'method="POST"') ?>
						    	
							        <div class="row">
							        	<div class="col-md-2"> Foto Restauran</div>
								        <div class="col-md-2">
								        	<div class="form-group">
								        		<input type="file" class="" name="userfile" size="20"/>
								        	</div>
								        </div>
							        </div>
							        <div class="row">
							        	<div class="col-md-2"></div>
							        	<div class="col-md-2 ">
							        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Tambahkan</button>
							        	</div>
							        </div>
						    	<?php echo form_close(); ?>
						    	<div class="table-responsive">
						    		<table class="table">
						    			<thead>
						    				<tr>
						    					
						    					<th>Foto</th>
						    					<th>Aksi</th>
						    				</tr>	
						    			</thead>
						    			<tbody>
						    			<?php if(!empty($record_foto)): ?>
						    					<?php foreach ($record_foto as $row):?>
								    				<tr>
								    					
								    					<td><img src="<?php echo $row->path_foto; ?>" style="width:100px;height:100px;"></td>
								    					<td> <a href="<?php echo base_url('owner/hapus_foto/'.$row->id_foto) ?>">Hapus</a></td>
								    				</tr>
						    					<?php endforeach; ?>
						    				<?php endif; ?>
						    			</tbody>

						    		</table>
						    	</div>
						    </div>
						    <div id="iklan" class="tab-pane fade">
						      <div class="col-md-12">
								<h3 style="margin-bottom:15px;">Request Iklan</h3>
									<?php echo form_open_multipart(base_url("owner/request_iklan"), 'method="POST"') ?>
							    		<div class="row">
								        	<div class="col-md-5"> Kirim email untuk pemasangan iklan <br></div>
								        </div>
								        <div class="row">
								        	<div class="col-md-2 ">
								        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Kirim email</button>
								        	</div>
								        </div>
								    <?php echo form_close(); ?>
								</div>
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