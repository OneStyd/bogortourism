<?php
	include "connect.php";
	
	$idw = $_POST['disapproved'];
	$dis = mysqli_query($conn, "UPDATE wisata SET status_wisata = 'no' WHERE id_wisata = '$idw'");
	
	if ($dis) {
?>
		<script language="javascript">alert("Post Tidak Desetujui");</script>
		<script>document.location.href='../moderate.php';</script>
<?php
	}
	else {
?>
		<script language="javascript">alert("Verifikasi Gagal");</script>
		<script>document.location.href='../moderate.php';</script>
<?php
	}
?>