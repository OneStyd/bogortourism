<?php
	include 'modul/connect.php';
	require 'header.php';
	
	if($_SESSION['id'] != "1"){
?>
		<script language="javascript">alert("Kamu tidak memiliki kewenangan membuka halaman ini");</script>
		<script>document.location.href='index.php';</script>
<?php
	}
	if($_SESSION['status'] == "Admin"){
		$id = $_SESSION['id'];
		$query = mysqli_query($conn, "SELECT * FROM member WHERE id_member = '$id'");
		$result = mysqli_fetch_array($query);
?>
		<style>		
			body {
				padding-left: 240px;
			}
	
			@media only screen and (max-width : 992px) {
				body {
					padding-left: 0;
				}
			}
			
			.side-nav li.active {
				background: #005500;
			}
		</style>
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
		<!-- Side Navigation -->
		<ul id="slide-out" class="side-nav fixed admin righteous">
			<center>
				<img src="<?php echo $result['photo_member']?>" class="circle">
				<h4 class="lobster" style="color: #fff;">Bogor Tourism</h4>
			</center>
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="#">Tulis Post</a></li>
			<li><a href="listmember.php">Daftar Member</a></li>
			<li><a href="listpost.php">Daftar Wisata</a></li>
			<li><a href="moderate.php">Daftar Request</a></li>
			<li class="hide-on-med-and-up"><a href="modul/logoutproses.php">Logout</a></li>
		</ul>
		
		<!-- Top Navigation -->
		<nav style="padding-right: 20px;">
			<div class="nav-wrapper">
				<a href="#!" class="brand-logo lobster hide-on-med-and-up">Bogor Tourism</a>
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
				<ul class="right hide-on-med-and-down righteous">
					<li><a href="modul/logoutproses.php"><i class="fa fa-sign-out fa-2x left"></i>Logout</a></li>
				</ul>
			</div>
		</nav>
		
		<div class="promotemin">
			<h5 class="center lobster">Promosikan Suatu Tempat Wisata</h5><hr class="garisitem"><br><br>
			<div class="row formpost z-depth-3">
				<form class ="col s12" name="postier" action="modul/adminpost.php" method="POST" enctype="multipart/form-data">
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
						<div id="map" style="width:85%; height:350px; border:2px solid #26A65B;"></div>
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
		
		<!-- Footer -->
		<footer class="footermin">
			<div class="row" style="margin-bottom: 0;">
				<div class="col s12">
					<a class="grey-text text-lighten-4" href="#!">© 2016 Bogor Tourism</a>
					<a class="grey-text text-lighten-4 right hide-on-med-and-down" href="#!">Group 9 - Wawan, Emiel, Rofiq, Alip</a>
				</div>
			</div>
		</footer>

	</body>
</html>
<?php
	}
?>