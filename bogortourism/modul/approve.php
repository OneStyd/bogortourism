<?php
	include "connect.php";
	
	$idw = $_POST['verified'];
	$verif = mysqli_query($conn, "UPDATE wisata SET status_wisata = 'yes' WHERE id_wisata = '$idw'");
	
	if ($verif) {
?>
		<script language="javascript">alert("Post Telah Disetujui");</script>
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