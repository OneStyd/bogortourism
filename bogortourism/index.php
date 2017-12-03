<!DOCTYPE html>
<?php
	include 'modul/connect.php';
	include "modul/page.php";
	require 'header.php';
  	
	if($_SESSION['status'] != "nouser"){
	    	$id = $_SESSION['id'];
		$query = mysqli_query($conn, "SELECT * FROM member WHERE id_member = '$id'");
		$result = mysqli_fetch_array($query);
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
					<li class="active"><a href="http://wawan.agri.web.id/bogortourism/"><i class="fa fa-home fa-2x left"></i>Home</a></li>
					<li><a href="archive.php"><i class="fa fa-archive fa-2x left"></i>Daftar Isi</a></li>
					<?php			
						if($_SESSION['status'] != "nouser"){
					?>
					<li><a class="dropdown-button" href="#" data-activates='dropdown1'><img src="<?php echo $result['photo_member']?>" class="circle left navimg"><?php echo $result['name_member']?></a></li>
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
					<li class="active"><a href="profile.php"><img src="<?php echo $result['photo_member']?>" class="circle left navimg"><?php echo $result['name_member']?></a></li>
					<?php
						}
					?>
					<li><a href="http://wawan.agri.web.id/bogortourism/">Home</a></li>
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

	<!-- Slider -->		
	<div class="slider">
		<ul class="slides">
			<li>
				<img src="img/alam.png">
				<div class="caption center-align">
					<h3 class="lobster">Wisata Alam</h3>
					<h5 class="white-text righteous">Rasakan pengalaman menarik di lingkungan yang indah</h5>
					<a href="page.php?category='Alam'" class="waves-effect waves-light btn slidebutton">Visit Now</a>
				</div>
			</li>
			<li>
				<img src="img/belanja.png"> 
				<div class="caption center-align">
					<h3 class="lobster">Wisata Belanja</h3>
					<h5 class="white-text righteous">Apapun yang kalian cari, Bogor memilikinya</h5>
					<a href="page.php?category='Belanja'" class="waves-effect waves-light btn slidebutton">Visit Now</a>
				</div>
			</li>
			<li>
				<img src="img/kuliner.png"> 
				<div class="caption center-align">
					<h3 class="lobster">Wisata Kuliner</h3>
					<h5 class="white-text righteous">Nikmati makanan khas yang penuh cita rasa</h5>
					<a href="page.php?category='Kuliner'" class="waves-effect waves-light btn slidebutton">Visit Now</a>
				</div>
			</li>
			<li>
				<img src="img/explore.png"> 
				<div class="caption center-align">
					<h3 class="lobster">Temukan petualangan barumu</h3>
					<h5 class="white-text righteous">bergabunglah dengan kami</h5>
					<a href="login.php" class="waves-effect waves-light btn slidebutton">Join Now</a>
				</div>
			</li>
		</ul>
	</div>

	<!-- Recent Post -->
	<div class="post">
		<div class="container">
			<br><center><span class="judul">Recommended Places</span></center><hr class="garisitem">
			<div class="carousel">
				<a class="carousel-item" href="post.php?id_post=1"><h6 class="center item">Kebun Raya Bogor</h6><img src="img/post/krb.jpg"></a>
				<a class="carousel-item" href="post.php?id_post=3"><h6 class="center item">Botani Square</h6><img src="img/post/bs.jpg"></a>
				<a class="carousel-item" href="post.php?id_post=2"><h6 class="center item">De Leuit</h6><img src="img/post/dl.jpg"></a>
				<a class="carousel-item" href="post.php?id_post=6"><h6 class="center item">Taman Wisata Mekarsari</h6><img src="img/post/msb.jpg"></a>
				<a class="carousel-item" href="post.php?id_post=7"><h6 class="center item">Cibinong City Mall</h6><img src="img/post/ccm.jpg"></a>
			</div>
			<div class="carouselbutton center">
				<a class="waves-effect waves-light btn prev" style="padding-left: 25px; padding-right: 25px;"><i class="fa fa-arrow-left fa-2x"></i></a>
				<a class="waves-effect waves-light btn next" style="padding-left: 25px; padding-right: 25px;"><i class="fa fa-arrow-right fa-2x"></i></a>
			</div>
		</div>
	</div>

	<!-- Search -->
	<div class="searching">
		<div class="container">
			<div class="row">
				<div class="col s5 pencarian">
					<br><center><span class="judul white-text">Search By Location</span></center><hr class="garisijo">
					<div class="row center">
						<form name="pencarianwilayah" action="modul/carilocproses.php" method="POST" enctype="multipart/form-data">
							<div class="input-field col s8">
								<select name="area">
									<option value="" disabled selected>Daerah Tempat Wisata</option>
									<option value="Bogor Barat">Bogor Barat</option>
									<option value="Bogor Selatan">Bogor Selatan</option>
									<option value="Bogor Tengah">Bogor Tengah</option>
									<option value="Bogor Timur">Bogor Timur</option>
									<option value="Bogor Utara">Bogor Utara</option>
									<option value="Kabupaten Bogor">Kabupaten Bogor</option>
								</select>
							</div>
							<div class="col s4">
								<button class="btn waves-effect waves-teal" style="margin-top: 25px;" type="submit">Search</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col s7 pencarian">
					<br><center><span class="judul white-text">Search By Budget</span></center><hr class="garisijo">
					<div class="row">
						<form name="pencarianbudget" action="modul/caribudgetproses.php" method="POST" enctype="multipart/form-data">
							<div class="col s5">
								<div class="input-field">
									<input placeholder="Min Budget" id="searchmin" name="caribudgetmin" type="search">
									<label for="searchmin"><i class="fa fa-search-minus fa-2x"></i></label>
								</div>
							</div>
							<div class="col s5">
								<div class="input-field">
									<input placeholder="Max Budget" name="caribudgetmax" id="searchmax" type="search">
									<label for="searchmax"><i class="fa fa-search-plus fa-2x"></i></label>
								</div>
							</div>
							<div class="col s2">
								<button class="btn waves-effect waves-teal" style="margin-top: 25px;" type="submit">Search</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Latest Post -->
	<div class="latestpost">
		<div class="container">
			<h4 class="lobster center">Latest Post</h4><hr class="garisitem"><br>
			<?php
				$limit = 0;
				if(isset($_GET['hal'])){
					for($i=1; $i<$_GET['hal']; $i++){
						$limit += 3;
					}
				}
				$hal = ambil_post($limit);
				while ($konten = mysqli_fetch_array($hal)){
					$tanggal = $konten['timestamp'];
					$string = $konten['about_wisata'];
					$string = rip_tags($string);
					$string = substr($string, 0, 200).'...';
					echo 
						'<div class="somepost z-depth-2" style="border-radius: 15px;">'.
							'<div class="row" style="border-top: 2px dashed #26A65B; border-bottom: 2px dashed #26A65B; border-radius: 30px;">'.
								'<div class="col s3 hide-on-med-and-down">'.
									'<img src="'.$konten['pic_wisata'].'" width=100% height=150px style="margin-left: 15px;">'.
								'</div>'.
								'<div class="col s9 preview">'.
									'<a href="post.php?id_post='.$konten['id_wisata'].'"><h5 class="righteous" style="padding=0px">'.$konten['name_wisata'].'</h5></a>'.
									'<span>Posted By '.$konten['author'].' <span class="hide-on-med-and-down">|</span><span class="hide-on-med-and-up"><br></span> On '.date_format(date_create($tanggal), 'd F Y').'<span class="hide-on-med-and-up"><br></span></span>'.
									'<img class="hide-on-med-and-up" src="'.$konten['pic_wisata'].'" width=150px height=150px style="border-radius: 15px; margin-top: 15px;">'.
									'<p>'.$string.'</p>'.
									'<a href="post.php?id_post='.$konten['id_wisata'].'" target="_blank"><button class="btn waves-effect waves-teal readmore">Read More</button></a>'.
								'</div>'.
							'</div>'.
						'</div>
					';
				}
				if(isset($_GET['hal'])){
					$next = $_GET['hal']+1;
					$prev = $_GET['hal']-1;}
				else{
					$next = 2;
					$prev = 0;
				}
				echo '<div style="margin: 30px 0px;">';

				if($prev > 0){ 
					echo '<a class="waves-effect waves-light btn z-depth-2" href="?hal='.$prev.'" style="float: left; padding-left: 25px; padding-right: 25px;"><< Prev</a>';
				}
				
				$test=ambil_post($limit+3);
				
				if(mysqli_num_rows($test)!=0){
					echo '<a class="waves-effect waves-light btn z-depth-2" href="?hal='.$next.'" style="float: right; padding-left: 25px; padding-right: 25px;">Next >></a>';
				}
				echo'</div><br>';
			?>					
		</div>
	</div><br>

<?php
	require 'footer.php';
?>