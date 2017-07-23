<html>
<head>
	<title></title>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datatables/css/jquery.datatables.css">

	
	


 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
 <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>




<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>





<script type="text/javascript">
	$(document).ready(function(){
		

		 // Build the chart
  Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Jumlah pesanan yang masuk perhari'
    }/*,
    subtitle: {
        text: 'Source: WorldClimate.com'
    }*/,
    xAxis: {
        categories: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']
    },
    yAxis: {
        title: {
            text: 'Jumlah Pesanan'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: '<?php echo $nama_resto; ?>',
        data: [<?php echo $senin ?>,<?php echo $selasa ?>,<?php echo $rabu ?>,<?php echo $kamis ?>,<?php echo $jumat ?>,<?php echo $sabtu ?>,<?php echo $minggu ?>]
    }]
});
		
		
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

				<?php echo form_open_multipart(base_url("owner/index"), 'method="POST"') ?>
		    		<div class="row">
			        	<div class="form-group has-feedback">
						<select class="combobox form-control" name="bulan" prompt="Bulan">
							<option value="" disabled selected>Bulan</option>

							<!-- DIBERI BATAS SESUAI KAPASITAS YANG DISETTING -->
						
							
							<option value="January">JAN</option>
							<option value="February">FEB</option>
							<option value="March">MAR</option>
							<option value="April">APR</option>
							<option value="May">MEI</option>
							<option value="June">JUN</option>
							<option value="July">JUL</option>
							<option value="August">AGU</option>
							<option value="September">SEPT</option>
							<option value="October">OKT</option>
							<option value="November">NOV</option>
							<option value="December">DES</option>
							
						</select>
					</div>
			        </div>
			        <div class="row">
			        	<div class="col-md-2"></div>
			        	<div class="col-md-2 ">
			        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Cari</button>
			        	</div>
			        </div>
			    <?php echo form_close(); ?>
				
			    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			</div>
			
			
		</div>
	</div>
</div>
</body>
</html>