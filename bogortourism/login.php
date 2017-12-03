<!DOCTYPE html>
<?php
	include 'modul/connect.php';
	require 'header.php';
  
	if($_SESSION['status'] != "nouser"){
		if($_SESSION['id'] == "1"){
			header('Location:dashboard.php');
		}
		else{
			header('Location:profile.php');
		}
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
				<li class="active"><a href="#"><i class="fa fa-sign-in fa-2x left"></i>Login/Register</a></li>
			</ul>
			<ul class="side-nav righteous" id="mobile-demo">
				<li><a href="index.php">Home</a></li>
				<li><a href="archive.php">Daftar Isi</a></li>
				<li><a href="#">Login/Register</a></li>
			</ul>
		</div>
	</nav>
</div>

<!-- Form Login -->
<div class="container">
	<br><br><h4 class="center lobster">Form Login</h2><hr class="garisitem">
</div>
<div class="formlogin">
	<div class="container z-depth-3">
		<div class="row" style="padding: 30px">
			<div class="col s12">
				<form class ="col s12 pinggiran" name="cekdatabase" action="modul/loginproses.php" method="POST" enctype="multipart/form-data">
					<div class="row">	
						<div class="input-field col s12 item">
							<i class="fa fa-envelope prefix"></i>
							<input type="email" name="emailogin" id="emailogin" required>
							<label class="item" for="emailogin">Email</label>
						</div>
						<div class="input-field col s12 item">
							<i class="fa fa-key prefix"></i>
							<input type="password" name="passlogin" id="passlogin" min="8" required>
							<label class="item" for="passlogin">Password</label>
						</div>
						<div class="col s12">
							<a class="modal-trigger waves-effect waves-light btn-flat regisbutton" href="#regis">Dont have an account? <span style="color: #008000;">Register Now</span></a>
						</div>
						<div class="input-field col s12"><br></div>
						<div class="row center">
							<button class="btn waves-effect waves-teal" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- regis begin structure -->
	<div id="regis" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4 class="center lobster item">Form Registrasi</h4><hr class="garisitem"><br>
			<div class="row">
				<div class="col s12 pinggiran">
					<form class ="col s12" name="uploader" action="modul/daftarproses.php" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="input-field col s12">
								<i class="fa fa-user prefix"></i>
								<input type="text" name="namauser" id="namauser" required>
								<label class="item" for="namauser">Name</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-envelope prefix"></i>
								<input type="email" name="emailuser" id="emailuser" required>
								<label class="item" for="emailuser">Email</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-key prefix"></i>
								<input type="password" name="passuser" id="passuser" min="8" required>
								<label class="item" for="passuser">Password</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-calendar prefix"></i>
								<input type="date" name="dateuser" id="dateuser" class="datepicker" required>
								<label class="active item" for="dateuser">Birth</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-phone prefix"></i>
								<input type="number" name="telpuser" id="telpuser" required>
								<label class="item" for="telpuser">Phone</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-map-marker prefix"></i>
								<input type="text" name="alamatuser" id="textareaku" required>
								<label class="item" for="textareaku">Address</label>
							</div>
							<div class="input-field col s12">
								<div class="file-field input-field">
									<div class="btn" style="padding-left:25px; padding-right:25px;">
										<span>Photo</span>
										<input type="file" name="photomember" required>
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text" placeholder="Upload your photo, max 1 MB">
									</div>
								</div>
							</div>
							<div class="input-field col s12">
								<ul class="collapsible" data-collapsible="accordion">
									<li>
										<div class="collapsible-header center"><i class="fa fa-angle-double-down right"></i>Agreement</div>
										<div class="collapsible-body">
											<p>
												Pihak Bogor Tourism tidak bertanggung jawab atas keaslian data yang ada disini, 
												Kami hanya memberikan fasilitas untuk saling berbagi.
												Segala bentuk penipuan harap dipertanggungjawabkan oleh orang yang bersangkutan.
											</p></div>
									</li>
								</ul>
								<input type="checkbox" id="test" required>
								<label class="item" for="test">Agree</label>
							</div>
							<div class="input-field col s12"><br></div>
							<div class="row center">
								<button class="btn waves-effect waves-teal" type="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="fa fa-close right"></i>Close</a>
			</div>
	</div>
	<!-- /regis end structure -->

</div>

<?php
	require 'footer.php';
?>