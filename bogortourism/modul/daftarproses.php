<?php
	include "connect.php";

	$name = $_POST['namauser'];
	$email = $_POST['emailuser'];
	$pass = $_POST['passuser'];
	$dob = $_POST['dateuser'];
	$phone = $_POST['telpuser'];
	$address = $_POST['alamatuser'];
	$folder = "img/member";
	$upload_dir = "../img/member";
	$photo_size = $_FILES["photomember"]["size"];
	$photo_loc = $_FILES["photomember"]["tmp_name"];
	$photo_name = $_FILES["photomember"]["name"];
	
	if($photo_size < 1000000){
		move_uploaded_file($photo_loc, "$upload_dir/$photo_name");
		$sql_tambah = "INSERT INTO member(id_member, name_member, email_member, pass_member, date_member, phone_member, address_member, photo_member) 
					  VALUE('','$name','$email','$pass','$dob','$phone','$address','$folder/$photo_name')";
		mysqli_query($conn, $sql_tambah);
?>
		<script language="javascript">alert("Register Successful");</script>
		<script>document.location.href='../login.php';</script>
<?php
	}
	else{
?>
		<script language="javascript">alert("Register Failed");</script>
		<script>document.location.href='../login.php';</script>
<?php
	}
	mysqli_close($conn);
?>