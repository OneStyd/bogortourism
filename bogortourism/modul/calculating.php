<?php 
	$lat = $_POST['lat']; 
	$long = $_POST['long'];
	$idp = $_POST['idpost'];
?>
<script>
	document.location.href='../calculate.php?latuser=<?php echo $lat ?>&longuser=<?php echo $long ?>&id_post=<?php echo $idp ?>';
</script>