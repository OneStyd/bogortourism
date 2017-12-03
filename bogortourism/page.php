<!DOCTYPE html>
<html lang="en">
<?php
	include 'modul/connect.php';
	include 'modul/rip.php';
	require 'header.php';
  
	if($_SESSION['status'] != "nouser"){
	    $id = $_SESSION['id'];
		$query = mysqli_query($conn, "SELECT * FROM member WHERE id_member = '$id'");
		$result = mysqli_fetch_array($query);
	}
	if(isset($_GET['category'])){
		$qry = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes' AND category_wisata = ".$_GET['category']."");
		$qry2 = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes' AND category_wisata = ".$_GET['category']."");
	}
	else if(isset($_GET['area'])){
		$qry = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes' AND area_wisata = ".$_GET['area']."");
		$qry2 = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes' AND area_wisata = ".$_GET['area']."");
	}
	else if(isset($_GET['min']) && isset($_GET['max'])){
		$qry = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes' AND budget_wisata BETWEEN ".$_GET['min']." AND ".$_GET['max']."");
		$qry2 = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes' AND budget_wisata BETWEEN ".$_GET['min']." AND ".$_GET['max']."");
	}
	else{
		header("location: error.php");
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
	<div class="halamansearch">
		<div class="container z-depth-3">
			<div class="row">
				<div class="col s9 kontensearch">
					<h4 class="center lobster" style="color: #4caf50"><strong>Hasil Pencarian</strong></h4><hr>
					<?php 
						if(empty($cek = mysqli_fetch_array($qry2))) echo '<center>Tidak Ada Hasil</center>';
						while ($konten = mysqli_fetch_array($qry)){
							$tanggal = $konten['timestamp'];
							$string = $konten['about_wisata'];
							$string = rip_tags($string);
							$string = substr($string, 0, 120).'...';
							echo 
								'<div class="hasilcari">'.
									'<div class="row">'.
										'<div class="col s10">'.
											'<a href="post.php?id_post='.$konten['id_wisata'].'"><h5 class="righteous" style="padding=0px">'.$konten['name_wisata'].'</h5></a>'.
											'<p class="hide-on-med-and-down">'.$string.'</p>'.
										'</div>'.
										'<div class="col s2">'.
											'<a href="post.php?id_post='.$konten['id_wisata'].'" target="_blank"><button class="btn waves-effect waves-teal goread">Read >></button></a>'.
										'</div>'.
									'</div>'.
								'</div>
							';
						}
					?>
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