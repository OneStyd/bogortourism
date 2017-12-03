<?php
	$page = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes' ORDER BY id_wisata DESC LIMIT 0,3");
	
	function ambil_post($limit){
		$conn = mysqli_connect('localhost', 'root', '', 'bogor_tourism') or die ("Gagal koneksi ke server".mysqli_error());
		$page = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes' ORDER BY id_wisata DESC LIMIT $limit,3");
		return $page;
	}

	function rip_tags($string) { 
		$string = preg_replace ('/<[^>]*>/', ' ', $string); 
		$string = str_replace("\r", '', $string);
		$string = str_replace("\n", ' ', $string);
		$string = str_replace("\t", ' ', $string);
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		
		return $string; 
	}
?>