<html>
<head>
	<title>fancybox</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.css" media="screen">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		alert("asdaasdasdasd");
		$(".perbesar").fancybox();
	});
	</script>
</head>
<body>
<a href="<?php echo base_url(); ?>uploads/tes.jpg" class="perbesar" >
<img src="<?php echo base_url(); ?>uploads/tes.jpg" width="100">
</a>
</body>
</html>