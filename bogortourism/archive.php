<!DOCTYPE html>
<?php
	include 'modul/connect.php';
	require 'header.php';
  
	$query2 = mysqli_query($conn, "SELECT * FROM wisata WHERE category_wisata = 'Alam' AND status_wisata = 'yes'");
	$query3 = mysqli_query($conn, "SELECT * FROM wisata WHERE category_wisata = 'Alam' AND status_wisata = 'yes'");
	$query4 = mysqli_query($conn, "SELECT * FROM wisata WHERE category_wisata = 'Belanja' AND status_wisata = 'yes'");
	$query5 = mysqli_query($conn, "SELECT * FROM wisata WHERE category_wisata = 'Belanja' AND status_wisata = 'yes'");
	$query6 = mysqli_query($conn, "SELECT * FROM wisata WHERE category_wisata = 'Kuliner' AND status_wisata = 'yes'");
	$query7 = mysqli_query($conn, "SELECT * FROM wisata WHERE category_wisata = 'Kuliner' AND status_wisata = 'yes'");
  	
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
				<li><a href="index.php"><i class="fa fa-home fa-2x left"></i>Home</a></li>
				<li class="active"><a href="#"><i class="fa fa-archive fa-2x left"></i>Daftar Isi</a></li>
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
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Daftar Isi</a></li>
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

<!-- Daftar Isi -->
<div class="daftarisi">
	<div class="container">
		<h5 class="center lobster">Daftar Tempat Wisata</h5><hr class="garisitem"><br>
		<ul class="collapsible popout" data-collapsible="accordion">
			<li>
				<div class="collapsible-header"><i class="fa fa-tree"></i>Wisata Alam</div>
				<div class="collapsible-body">
					<?php 
						if($result2 = mysqli_fetch_array($query2)){
					?>
						<ul class="archivelist">
						<?php
							$counta = 1;
							while($result3 = mysqli_fetch_array($query3)){
								echo '<li>'.$counta++.'&nbsp;&nbsp;<a href="post.php?id_post='.$result3['id_wisata'].'" target="_blank">&nbsp;&nbsp;'.$result3['name_wisata'].'</a></li>';
							}
						?>
						</ul>
					<?php 
						} 
						else {
					?>
							<p style="padding: 10px 60px;">Belum Ada</p>
					<?php
						}
					?>
				</div>
			</li>
			<li>
				<div class="collapsible-header"><i class="fa fa-shopping-cart"></i>Wisata Belanja</div>
				<div class="collapsible-body">
					<?php 
						if($result4 = mysqli_fetch_array($query4)){
					?>
						<ul class="archivelist">
						<?php
							$countb = 1;
							while($result5 = mysqli_fetch_array($query5)){
								echo '<li>'.$countb++.'.&nbsp;&nbsp;<a href="post.php?id_post='.$result5['id_wisata'].'" target="_blank">&nbsp;&nbsp;'.$result5['name_wisata'].'</a></li>';
							}
						?>
						</ul>
					<?php 
						} 
						else {
					?>
							<p style="padding: 10px 60px;">Belum Ada</p>
					<?php
						}
					?>
				</div>
			</li>
			<li>
				<div class="collapsible-header"><i class="fa fa-cutlery"></i>Wisata Kuliner</div>
				<div class="collapsible-body">
					<?php 
						if($result6 = mysqli_fetch_array($query6)){
					?>
						<ul class="archivelist">
						<?php
							$countk = 1;
							while($result7 = mysqli_fetch_array($query7)){
								echo '<li>'.$countk++.'.&nbsp;&nbsp;<a href="post.php?id_post='.$result7['id_wisata'].'" target="_blank">&nbsp;&nbsp;'.$result7['name_wisata'].'</a></li>';
							}
						?>
						</ul>
					<?php 
						} 
						else {
					?>
							<p style="padding: 10px 60px;">Belum Ada</p>
					<?php
						}
					?>
				</div>
			</li>
		</ul>
	</div>
</div>

<?php
	require 'footer.php';
?>