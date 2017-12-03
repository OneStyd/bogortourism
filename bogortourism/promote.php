<!DOCTYPE html>
<?php
	include 'modul/connect.php';
	require 'header.php';
  	
  	if($_SESSION['status'] == "Admin"){
		header('Location:adminpost.php');
	}
	if($_SESSION['status'] == "nouser"){
		header('Location:login.php');
	}
	if($_SESSION['status'] == "user"){
	    $id = $_SESSION['id'];
		$query = mysqli_query($conn, "SELECT * FROM member WHERE id_member = '$id'");
		$result = mysqli_fetch_array($query);
	}
?>

	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({
			selector: '#isiartikel',
			theme: 'modern',
			height: 250,
			plugins: [
				'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
				'save table contextmenu directionality emoticons template paste textcolor'
			],
			content_css: 'css/content.css',
			toolbar: 'insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | numlist outdent indent | link image | preview fullpage | forecolor backcolor'
		});
	</script>
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
					<li><a class="dropdown-button" href="#" data-activates='dropdown1'><img src="<?php echo $result['photo_member']?>" class="circle left navimg"><?php echo $result['name_member']?></a></li>
				</ul>
				<ul class="side-nav righteous" id="mobile-demo">
					<li class="active"><a href="profile.php"><img src="<?php echo $result['photo_member']?>" class="circle left navimg"><?php echo $result['name_member']?></a></li>
					<li><a href="index.php">Home</a></li>
					<li><a href="archive.php">Daftar Isi</a></li>
					<li><a href="#">Promote</a></li>
					<li><a href="modul/logoutproses.php">Logout</a></li>
				</ul>
			</div>
		</nav>
	</div>

	<!-- Dropdown Structure -->
	<ul id='dropdown1' class='dropdown-content'>
		<li><a href="profile.php">Profile</a></li>
		<li><a href="#">Promote</a></li>
		<li><a href="modul/logoutproses.php">Logout</a></li>
	</ul>

	<!-- Buat Artikel -->
	<div class="promoteme">
		<div class="container">
			<h5 class="center lobster">Promosikan Tempat Wisata Anda</h5><hr class="garisitem"><br><br>
			<div class="row formpost z-depth-3">
				<form class ="col s12" name="poster" action="modul/uploadpost.php" method="POST" enctype="multipart/form-data">
					<div class="input-field col s12">
						<i class="fa fa-star prefix"></i>
						<input type="text" name="judulpost" id="judulpost" required>
						<label class="item" for="judulpost">Nama Tempat Wisata</label>
					</div>
					<div class="input-field col s12">
						<i class="fa fa-dollar prefix"></i>
						<input type="number" name="budgetpost" id="budgetpost" required>
						<label class="item" for="budgetpost">Budget Yang Dibutuhkan</label>
					</div>
					<div class="input-field col s6">
						<select name="kategori" required>
							<option value="" disabled selected>Kategori Tempat Wisata</option>
							<option value="Alam">Wisata Alam</option>
							<option value="Belanja">Wisata Belanja</option>
							<option value="Kuliner">Wisata Kuliner</option>
						</select>
					</div>
					<div class="input-field col s6">
						<select name="area" required>
							<option value="" disabled selected>Daerah Tempat Wisata</option>
							<option value="Bogor Barat">Bogor Barat</option>
							<option value="Bogor Selatan">Bogor Selatan</option>
							<option value="Bogor Tengah">Bogor Tengah</option>
							<option value="Bogor Timur">Bogor Timur</option>
							<option value="Bogor Utara">Bogor Utara</option>
							<option value="Kabupaten Bogor">Kabupaten Bogor</option>
						</select>
					</div>
					<div class="input-field col s12" style="margin-bottom: 20px;">
						<textarea id="isiartikel" name="isipost"></textarea>
					</div>
					<center style="margin: 20px 0px;">
						Klik Lokasi Tempat Wisata pada Map untuk mendapatkan latitude dan longitude
						<div id="map" style="width:85%; height:350px; border:2px solid #00ff00;"></div>
					</center>
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
					<script type="text/javascript">
						function initMap() {
							var bogor = {lat: -6.5950181, lng: 106.7218509};
							
							var map = new google.maps.Map(document.getElementById('map'), {
								center: bogor,
								scrollwheel: false,
								zoom: 12
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
					<div class="col s12">
						<div class="file-field input-field">
							<div class="btn" style="padding-left:25px; padding-right:25px;">
								<span>Cover Picture</span>
								<input type="file" name="coverpic" required>
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text" placeholder="Upload your cover picture, max 1 MB">
							</div>
						</div>
					</div>
					<div class="row center">
						<button class="btn waves-effect waves-teal" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php
	require 'footer.php';
?>