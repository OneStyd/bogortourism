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
	</head>
	
	<body>
		<!-- Side Navigation -->
		<ul id="slide-out" class="side-nav fixed admin righteous">
			<center>
				<img src="<?php echo $result['photo_member']?>" class="circle">
				<h4 class="lobster" style="color: #fff;">Bogor Tourism</h4>
			</center>
			<li><a href="#!">Dashboard</a></li>
			<li><a href="adminpost.php">Tulis Post</a></li>
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
		
		<div class="dashboard">
			<center><br>
				<h4 class="lobster">Dashboard</h4>
				<h6 class="righteous">Informasi Umum</h6>
				<hr class="garisitem"><br>
				<div class="row"><br>
					<div class="col s4">
						<div class="cmember"><br>
							<h3><i class="fa fa-users"></i></h3>
							<h5 class="hide-on-med-and-down righteous">Total Member</h5>
							<a href="listmember.php" style="color: #000;"><h5>
								<?php 
									$query2 = mysqli_query($conn, "SELECT * FROM member WHERE id_member != '1'"); 
									$hitung = mysqli_num_rows($query2);
									echo $hitung;
								?>
							</h5></a><br>
						</div>
					</div>
					<div class="col s4">
						<div class="cpost"><br>
							<h3><i class="fa fa-calendar-check-o"></i></h3>
							<h5 class="hide-on-med-and-down righteous">Total Post</h5>
							<a href="listpost.php" style="color: #000;"><h5>
								<?php 
									$query3 = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yes'"); 
									$hitung2 = mysqli_num_rows($query3);
									echo $hitung2;
								?>
							</h5></a><br>
						</div>
					</div>
					<div class="col s4">
						<div class="cpost"><br>
							<h3><i class="fa fa-calendar-times-o"></i></h3>
							<h5 class="hide-on-med-and-down righteous">Total Request</h5>
							<a href="moderate.php" style="color: #000;"><h5>
								<?php 
									$query4 = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yet'"); 
									$hitung3 = mysqli_num_rows($query4);
									echo $hitung3;
								?>
							</h5></a><br>
						</div>
					</div>
				</div>
			<br></center>
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