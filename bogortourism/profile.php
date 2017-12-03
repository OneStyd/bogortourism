<?php
	include 'modul/connect.php';
	require 'header.php';
	
	if($_SESSION['status'] == "Admin"){
		header('Location:dashboard.php');
	}
	if($_SESSION['status'] == "nouser"){
		header('Location:login.php');
	}
	else{
	    	$id = $_SESSION['id'];
		$query = mysqli_query($conn, "SELECT * FROM member WHERE id_member = '$id'");
		$result = mysqli_fetch_array($query);
		$author = $result['name_member'];
		$query2 = mysqli_query($conn, "SELECT * FROM wisata WHERE author = '$author'");
		$query3 = mysqli_query($conn, "SELECT * FROM wisata WHERE author = '$author'");
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
				<li class="active"><a class="dropdown-button" href="#" data-activates='dropdown1'><img src="<?php echo $result['photo_member']?>" class="circle left navimg"><?php echo $result['name_member']?></a></li>
			</ul>
			<ul class="side-nav righteous" id="mobile-demo">
				<li class="active"><a href="#"><img src="<?php echo $result['photo_member']?>" class="circle left navimg"><?php echo $result['name_member']?></a></li>
				<li><a href="index.php">Home</a></li>
				<li><a href="archive.php">Daftar Isi</a></li>
				<li><a href="promote.php">Promote</a></li>
				<li><a href="modul/logoutproses.php">Logout</a></li>
			</ul>
		</div>
	</nav>
</div>

<!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
	<li><a href="#">Profile</a></li>
	<li><a href="promote.php">Promote</a></li>
	<li><a href="modul/logoutproses.php">Logout</a></li>
</ul>

<!-- Profil -->
<div class="profil">
	<div class="container">
		<center><span class="judul"><?php echo $result['name_member']?>'s Profile</span></center><hr class="garisitem"><br>
		<div class="card">
			<div class="card-content">
				<div class="col s12 genimg">
					<ul class="tabs" class="hoverable">
						<li class="tab col s4"><a class="active" href="#general">General</a></li>
						<li class="tab col s4"><a href="#photo">Photo</a></li>
						<li class="tab col s4"><a href="#post">Post</a></li>
					</ul>
				</div>
				<div id="general" class="row">
					<div class="genimg col s4 hide-on-med-and-down">
						<img src="<?php echo $result['photo_member']?>" class="circle profilimg" alt="<?php echo $result['name_member']?>">
					</div>
					<div class="col s8 gendata">
						<table>
							<thead>
								<form action="modul/updategeneral.php">
									<tr>
										<th data-field="id">Profile</th>
										<th data-field="separator"></th>
										<th data-field="name"></th>
									</tr>
								</form>
							</thead>
							<tbody>
								<tr>
									<td>Name</td>
									<td>:</td>
									<td><?php echo $result['name_member']?></td>
								</tr>
								<tr>
									<td>Birth</td>
									<td>:</td>
									<td><?php echo $result['date_member']?></td>
								</tr>
								<tr>
									<td>Address</td>
									<td>:</td>
									<td><?php echo $result['address_member']?></td>
								</tr>
								<tr>
									<td>Phone</td>
									<td>:</td>
									<td><?php echo $result['phone_member']?></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td><button class="modal-trigger btn waves-effect waves-light" href="#genmodal">Change</button></td>
								</tr>								
							</tbody>
						</table>
					</div>
				</div>
				<div id="photo" class="row center collapse">
					<div class="col s12">
						<img src="<?php echo $result['photo_member']?>" class="profilimg" width="300" height="300" alt="<?php echo $result['name_member']?>">
					</div>
					<form action="modul/updatephoto.php"  name="uploader" method="post" enctype="multipart/form-data">
						<div class="col s12">
							<div class="file-field input-field">
								<div class="btn" style="padding-left:25px; padding-right:25px;">
									<span>Change</span>
									<input type="file" name="photobaru">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload your new photo">
								</div>
							</div>
						</div>
						<div class="col s12">
							<br><button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
						</div>
					</form>
				</div>
				<div id="post" class="row tabelpro">
					<?php if($result2 = mysqli_fetch_array($query2)){ ?>
					<table class="highlight">
						<thead>
							<tr>
								<th>#</th>
								<th>Tempat Wisata</th>
								<th>Status</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
					<?php
						$count = 1;
						while($result3 = mysqli_fetch_array($query3)){
							if ($result3['status_wisata'] == 'no'){
								echo '<tr><td>'.$count++.'</td><td>'.$result3['name_wisata'].'</td><td><i class="fa fa-times"></i></td><td>Post ini tidak disetujui oleh Admin</td></tr>';
							} else if ($result3['status_wisata'] == 'yes'){
								echo '<tr><td>'.$count++.'</td><td>'.$result3['name_wisata'].'</td><td><i class="fa fa-check"></i></td><td>Post ini telah disetujui oleh Admin</td></tr>';
							} else {
								echo '<tr><td>'.$count++.'</td><td>'.$result3['name_wisata'].'</td><td><i class="fa fa-minus"></i></td><td>Post ini belum dilihat oleh Admin</td></tr>';
							}
						}
						echo '</tbody></table>';
					}
					else {
					?>
					<p class="center">Anda belum mempromosikan apapun</p>
					<center><a href="promote.php">Promosikan Sekarang</a></center>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- genmodal begin structure -->
<div id="genmodal" class="modal modal-fixed-footer item">
	<div class="modal-content">
		<h4 class="center lobster item">Edit General Profile</h4><br>
		<div class="pinggiran">
			<div class="row">
				<div class="col s12">
					<form class ="col s12" name="genupdater" action="modul/updategeneral.php" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="input-field col s12">
								<i class="fa fa-user prefix"></i>
								<input value="<?php echo $result['name_member']?>" type="text" name="namabaru" id="namabaru" required>
								<label class="active item" for="namabaru">Name</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-calendar prefix"></i>
								<input value="<?php echo $result['date_member']?>" type="date" name="datebaru" id="datebaru" class="datepicker" required>
								<label class="active item" for="datebaru">Birth</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-map-marker prefix"></i>
								<input value="<?php echo $result['address_member']?>" type="text" name="alamatbaru" id="textareamu" required>
								<label class="active item" for="textareamu">Address</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-phone prefix"></i>
								<input value="<?php echo $result['phone_member']?>" type="number" name="telpbaru" id="telpbaru" required>
								<label class="active item" for="telpbaru">Phone</label>
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
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="fa fa-close right"></i>Cancel</a>
	</div>
</div>
<!-- /genmodal end structure -->

<?php
	require 'footer.php';
	}
?>