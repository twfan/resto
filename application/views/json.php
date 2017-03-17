<html>
<head>
	<title>Coba Json</title>
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
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.min.js"></script>
	

	<script type="text/javascript">
	$(document).ready(function(){
		$("button").click(function(){
			var kode_pelanggan = $(this).val();
			
			$.ajax({
				type:"post",
				dataType:"json",
				url:"<?php echo base_url('utama/json_proses')  ?>",
				data:{kode_pelanggan:kode_pelanggan},
				success:function(html)
				{
					/*var table = "<table><thead><tr><td>user_id</td><td>email</td><td>jenis_kelamin</td><td>nama_user</td><td>no_hp</td><td>password</td><td>status</td><td>tanggal_lahir</td></tr></thead><tbody><td>"+html[0].id_user+"</td><td>"+html[0].email+"</td><td>"+html[0].jenis_kelamin+"</td><td>"+html[0].nama_user+"</td><td>"+html[0].no_handphone+"</td><td>"+html[0].password+"</td><td>"+html[0].status_verifikasi+"</td><td>"+html[0].tanggal_lahir+"</td></tbody></table>";
					$(".data").append(table);*/
					for (var i = 0; i < html.length; i++) {
						var table = "<tr><td>"+html[i].id_user+"</td><td>"+html[i].email+"</td><td>"+html[i].jenis_kelamin+"</td><td>"+html[i].nama_user+"</td><td>"+html[i].no_handphone+"</td><td>"+html[i].password+"</td><td>"+html[i].status_verifikasi+"</td><td>"+html[i].tanggal_lahir+"</td></tr>";
						$(".data").append(table)
					};
					/*console.log(html.length);
					console.log(html);*/
				}

			});
		}); 
	});
	</script>

</head>  
<body>
<button value="UL1">user 1</button>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<td>user_id</td>
				<td>email</td>
				<td>jenis_kelamin</td>
				<td>nama_user</td>
				<td>no_hp</td>
				<td>password</td>
				<td>status</td>
				<td>tanggal_lahir</td>
			</tr>
		</thead>
		<tbody class="data">
			
		</tbody>
	</table>
</div>
</body>
</html>