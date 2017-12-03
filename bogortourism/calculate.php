<!DOCTYPE html>
<html lang="en">
<?php
	include 'modul/connect.php';
	require 'header.php';
  
	if($_SESSION['status'] != "nouser"){
	    $id = $_SESSION['id'];
		$query = mysqli_query($conn, "SELECT * FROM member WHERE id_member = '$id'");
		$result = mysqli_fetch_array($query);
	}
	
	$latuser = $_GET['latuser'];
	$longuser = $_GET['longuser'];
	$post = $_GET['id_post'];
	
	if(isset($_GET['id_post'])){
		$qry = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata = '$post'");
		$konten = mysqli_fetch_array($qry);
	}
	else{
		header("location: index.php");
	}
?>
</head>

<body>
	<!-- Navbar -->
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper">
				<a href="#!" class="brand-logo lobster">Bogor Tourism</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="fa fa-bars"></i></a>
				<ul class="right hide-on-med-and-down righteous">
					<li><a href="index.php"><i class="fa fa-home fa-2x left"></i>Home</a></li>
					<li><a href="archive.php"><i class="fa fa-archive fa-2x left"></i>Daftar Isi</a></li>
					<?php			
						if($_SESSION['status'] != "nouser"){
					?>
					<li><a class="dropdown-button" href="#" data-activates='dropdown1'><img src="<?php echo $result['photo_member']?>" class="circle left navimg"/><?php echo $result['name_member']?></a></li>
					<?php
						}
						else{
					?>
					<li><a href="login.php"><i class="fa fa-sign-in fa-2x left"></i>Login/Register</a></li>
					<?php
						}
					?>
				</ul>
				<ul class="side-nav righteous" id="mobile-demo">
					<?php			
						if($_SESSION['status'] != "nouser"){
					?>
					<li><a href="profile.php"><img src="<?php echo $result['photo_member']?>" class="circle left navimg"><?php echo $result['name_member']?></a></li>
					<?php
						}
					?>
					<li><a href="index.php">Home</a></li>
					<li><a href="archive.php">Daftar Isi</a></li>
					<?php			
						if($_SESSION['status'] != "nouser"){
					?>
					<li><a href="promote.php">Promote</a></li>
					<li><a href="modul/logoutproses.php">Logout</a></li>
					<?php
						}
						else{
					?>
					<li><a href="login.php">Login/Register</a></li>
					<?php
						}
					?>
				</ul>
			</div>
		</nav>
	</div>

	<!-- Dropdown Structure -->
	<ul id='dropdown1' class='dropdown-content'>
		<li><a href="profile.php">Profile</a></li>
		<li><a href="promote.php">Promote</a></li>
		<li><a href="modul/logoutproses.php">Logout</a></li>
	</ul>
	
	<!-- Halaman Calculate -->
	<div class="calcpage">
		<div class="container">
			<h5 class="center lobster">Travel Road</h5><hr class="garisitem">
			<p class="righteous">Jalur Menuju Lokasi :</p>
			<div id="map" class="calcmap"></div>
			<script type="text/javascript">
				function initMap() {
					var asal = {lat: <?php echo $latuser; ?>, lng: <?php echo $longuser; ?>};
					var tujuan = {lat: <?php echo $konten['latitude']; ?>, lng: <?php echo $konten['longitude']; ?>};
					
					var map = new google.maps.Map(document.getElementById('map'), {
						center: asal,
						scrollwheel: false,
						zoom: 7
					});
					
					var directionsDisplay = new google.maps.DirectionsRenderer({
						map: map
					});
					
					var request = {
						destination: tujuan,
						origin: asal,
						travelMode: google.maps.TravelMode.DRIVING
					};
					
					var directionsService = new google.maps.DirectionsService();
					directionsService.route(request, function(response, status) {
						if (status == google.maps.DirectionsStatus.OK) {
							directionsDisplay.setDirections(response);
						}
					});
				}
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeTMHQ3sm7_RXFEBlAbVRrHwCH6sOTSUU&signed_in=true&callback=initMap"
				async defer>
			</script>
			<p class="righteous">Rincian :</p>
			<?php
				function distance($lat1, $lon1, $lat2, $lon2, $unit) {
					$theta = $lon1 - $lon2;
					$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
					$dist = acos($dist);
					$dist = rad2deg($dist);
					$miles = $dist * 60 * 1.1515;
					$unit = strtoupper($unit);
	
					if ($unit == "K") {
						return round(($miles * 1.609344),3);
					} 
					else if ($unit == "N") {
						return round(($miles * 0.8684),3);
					} 
					else {
						return round($miles,3);
					}
				}
				$jarak = distance($latuser, $longuser, $konten['latitude'], $konten['longitude'], "K");
				$waktu = ceil(($jarak / 30) * 60);
				$biaya = ceil(($jarak / 10)* 6500);
			?>
			<div class="rinci z-depth-1">
				<table>
					<tr><td>Jarak Menuju Lokasi </td><td>=</td><td> <strong><?php echo $jarak ?></strong> Kilometers</td></tr>
					<tr><td>Perkiraan Waktu Menuju Lokasi </td><td>=</td><td> <strong><?php echo $waktu ?></strong> menit dengan asumsi kecepatan rata-rata 30 Km/jam</td></tr>
					<tr><td>Perkiraan Biaya Menuju Lokasi </td><td>=</td><td> <strong>Rp <?php echo $biaya ?></strong> dengan asumsi transportasi berkapasitas 10Km/liter dan harga BBM 6500 Rupiah/liter</td></tr>
				</table>
			</div>
		</div>
	</div>
  
<?php
	require 'footer.php';
?>