<?php
	include "connect.php";
	
	$judul = $_POST['judulpost'];
	$budget = $_POST['budgetpost'];
	$category = $_POST['kategori'];
	$areas = $_POST['area'];
	$isi = $_POST['isipost'];
	$lat = $_POST['lat'];
	if($lat == 0) {$lat = -6.5950181;}
	$long = $_POST['long'];
	if($long == 0) {$long = 106.7218509;}
	$folder = "img/post";
	$upload_dir = "../img/post";
	$photo_size = $_FILES["coverpic"]["size"];
	$photo_loc = $_FILES["coverpic"]["tmp_name"];
	$photo_name = $_FILES["coverpic"]["name"];
	$timestamp = date("Y-m-d H:i:s");
	
	if($photo_size < 1000000){
		move_uploaded_file($photo_loc, "$upload_dir/$photo_name");
		$sql_posting = "INSERT INTO wisata(id_wisata, author, name_wisata, budget_wisata, category_wisata, area_wisata, about_wisata, latitude, longitude, pic_wisata, timestamp, status_wisata) 
						VALUE('','Admin','$judul','$budget','$category','$areas','$isi','$lat','$long','$folder/$photo_name','$timestamp','yes')";
		mysqli_query($conn, $sql_posting);
?>
		<script language="javascript">alert("Posting Successful");</script>
		<script>document.location.href='../listpost.php';</script>
<?php
	}
	else{
?>
		<script language="javascript">alert("Posting Failed, Please Try Again");</script>
		<script>document.location.href='../promote.php';</script>
<?php
	}
?>