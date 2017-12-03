<?php 
	$wilayah = $_POST['area'];
	if(isset($wilayah)){
?>
	<script>
		document.location.href='../page.php?area="<?php echo $wilayah ?>"';
	</script>
<?php 
	}
	else {
?>
	<script>
		document.location.href='../error.php';
	</script>
<?php
	}
?>