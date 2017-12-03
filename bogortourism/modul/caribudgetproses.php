<?php 
	$bmin = $_POST['caribudgetmin']; 
	$bmax = $_POST['caribudgetmax'];
	if(empty($bmin)) {$bmin = 0;}
	if($bmax ==0) {header('Location:../error.php');}
	if(empty($bmax)) {$bmax = 100000000;}
?>
<script>
	document.location.href='../page.php?min="<?php echo $bmin ?>"&max="<?php echo $bmax ?>"';
</script>