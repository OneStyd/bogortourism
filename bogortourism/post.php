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
	if(isset($_GET['id_post'])){
		$qry = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata = '".$_GET['id_post']."'");
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
	
	<!-- Halaman Post -->
	<div class="halamanpost">
		<div class="container z-depth-3">
			<div class="row">
				<div class="col s9 kontenpost">
					<h4 class="center lobster" style="color: #4caf50"><strong><?php echo $konten['name_wisata']; ?></strong></h4><hr>
					<h6 style="float: left;">Dibuat oleh <?php echo $konten['author']; ?></h6><h6 style="float: right;">Pada <?php echo date_format(date_create($konten['timestamp']),"d F Y"); ?></h6>
					<br><br><img class="postimg" src="<?php echo $konten['pic_wisata']; ?>"><br>
					<?php echo $konten['about_wisata']; ?>
					<strong class="righteous">Lokasi :</strong>
					<div class="postmap">
						<div id="map" style="width:100%;height:200px;"></div>
						<div class="mapdetail hide-on-med-and-down">
							<div class="col s6"><strong>Latitude : </strong><span id="latspan"></span></div>
							<div class="col s6"><strong>Longitude: </strong><span id="lngspan"></span></div>
						</div>
					</div>
					<script type="text/javascript">
						function initMap() {
							var wisata = {lat: <?php echo $konten['latitude']; ?>, lng: <?php echo $konten['longitude']; ?>};
							
							var map = new google.maps.Map(document.getElementById('map'), {
								center: wisata,
								scrollwheel: false,
								zoom: 15
							});

							var marker = new google.maps.Marker({
								map: map,
								position: wisata,
								title: '<?php echo $konten['name_wisata']; ?>'
							});
								
							google.maps.event.addListener(map, 'mousemove', function(event){
								document.getElementById('latspan').innerHTML = event.latLng.lat();
								document.getElementById('lngspan').innerHTML = event.latLng.lng();
							});
							
							google.maps.event.addListener(map, 'click', function(event){
								document.getElementById('lat').value = event.latLng.lat();
								document.getElementById('long').value = event.latLng.lng();
							});
						}
					</script>
					<script async defer
						src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeTMHQ3sm7_RXFEBlAbVRrHwCH6sOTSUU&callback=initMap">
					</script>
					<p>Ingin tau jalur dari posisi anda ke tempat wisata ini?<br>Silahkan klik lokasi Anda pada map di atas lalu klik tombol "Calculate"</p>
					<form class ="col s12" name="calculater" action="modul/calculating.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="idpost" value="<?php echo $konten['id_wisata']; ?>">
						<div class="input-field col s6">
							<i class="fa fa-map prefix"></i>
							<input type="text" name="lat" id="lat" value="0">
							<label class="item" for="latpost">Latitude</label>
						</div>
						<div class="input-field col s6">
							<i class="fa fa-map prefix"></i>
							<input type="text" name="long" id="long" value="0">
							<label class="item" for="long">Longitude</label>
						</div>
						<div class="center">
							<button class="btn waves-effect waves-teal" type="submit" style="margin-bottom: 10px;">Calculate</button>
						</div>
					</form>
					<strong class="righteous">Kategori : <a href="page.php?category='<?php echo $konten['category_wisata'];?>'">Wisata <?php echo $konten['category_wisata'];?></a>, <a href="page.php?area='<?php echo $konten['area_wisata'];?>'"><?php echo $konten['area_wisata'];?></a></strong><br>
				</div>
				<div class="col s3 postsidebar hide-on-med-and-down">
					<div class="kategori">
						<div class="kathead">
							<h5 class="righteous center">Kategori</h5>
						</div>
						<div class="katbody">
							<ul>
								<li><a href="page.php?category='Alam'">> Wisata Alam</a></li>
								<li><a href="page.php?category='Belanja'">> Wisata Belanja</a></li>
								<li><a href="page.php?category='Kuliner'">> Wisata Kuliner</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col s3 postsidebar hide-on-med-and-down">
					<div class="kategori">
						<div class="kathead">
							<h5 class="righteous center">Daerah Lain</h5>
						</div>
						<div class="katbody">
							<ul>
								<li><a href="page.php?area='Bogor Barat'">> Bogor Barat</a></li>
								<li><a href="page.php?area='Bogor Selatan'">> Bogor Selatan</a></li>
								<li><a href="page.php?area='Bogor Tengah'">> Bogor Tengah</a></li>
								<li><a href="page.php?area='Bogor Timur'">> Bogor Timur</a></li>
								<li><a href="page.php?area='Bogor Utara'">> Bogor Utara</a></li>
								<li><a href="page.php?area='Kabupaten Bogor'">> Kabupaten Bogor</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php
	require 'footer.php';
?>