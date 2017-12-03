<?php
	include "connect.php";
	if($_SESSION['status'] == 'user') {
		$id = $_SESSION['id'];
		$nama = $_POST['namabaru'];
		$birth = $_POST['datebaru'];
		$alamat = $_POST['alamatbaru'];
		$newphone = $_POST['telpbaru'];
		$result2 = mysqli_query($conn, "UPDATE member SET name_member = '$nama', date_member = '$birth', address_member = '$alamat', phone_member = '$newphone' WHERE id_member = '$id'");
		
		if ($result2) {
?>
			<script language="javascript">alert("Update Successful");</script>
			<script>document.location.href='../profile.php';</script>
<?php
		}
		else {
?>
			<script language="javascript">alert("Update Failed");</script>
			<script>document.location.href='../profile.php';</script>
<?php
		}
	}
?>