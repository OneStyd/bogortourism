<?php
	include 'modul/connect.php';
	require 'header.php';
	
	if($_SESSION['id'] != "1"){
?>
		<script language="javascript">alert("You don't have permission to this page");</script>
		<script>document.location.href='index.php';</script>
<?php
	}
	if($_SESSION['status'] == "Admin"){
		$id = $_SESSION['id'];
		$query = mysqli_query($conn, "SELECT * FROM member WHERE id_member = '$id'");
		$query2 = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yet'");
		$query3 = mysqli_query($conn, "SELECT * FROM wisata WHERE status_wisata = 'yet'");
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
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="adminpost.php">Tulis Post</a></li>
			<li><a href="listmember.php">Daftar Member</a></li>
			<li><a href="listpost.php">Daftar Wisata</a></li>
			<li><a href="#">Daftar Request</a></li>
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
		
		<div class="dashboard" style="padding-bottom: 70px;">
			<center><br>
				<h5 class="lobster">Request Tempat Wisata Bogor Tourism</h5>
				<hr class="garisitem"><br>
				<?php 
					if($result2 = mysqli_fetch_array($query2)){ 
				?>
					<table class="highlight centered">
						<thead>
							<tr>
								<th class="hide-on-med-and-down">#</th>
								<th>Tempat Wisata</th>
								<th class="hide-on-med-and-down">Author</th>
								<th class="hide-on-med-and-down">Kategori</th>
								<th class="hide-on-med-and-down">Budget</th>
								<th class="hide-on-med-and-down">Daerah</th>
								<th colspan=3>Action</th>
							</tr>
						</thead>
						<tbody>
					<?php
						$count = 1;
						while($result3 = mysqli_fetch_array($query3)){
							echo '
							<!-- preview begin structure -->
							<div id="preview'.$count.'" class="modal modal-fixed-footer item">
								<div class="modal-content" style="text-align: left;">
									<img class="postimg" src="'.$result3["pic_wisata"].'"><br>
									'.$result3['about_wisata'].'
								</div>
								<div class="modal-footer">
									<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="fa fa-close right"></i>Close</a>
								</div>
							</div>
							<!-- /preview end structure -->
							<tr>
									<td class="hide-on-med-and-down">'.$count.'</td>
									<td>'.$result3['name_wisata'].'</td>
									<td class="hide-on-med-and-down">'.$result3['author'].'</td>
									<td class="hide-on-med-and-down">'.$result3['category_wisata'].'</td>
									<td class="hide-on-med-and-down">'.$result3['budget_wisata'].'</td>
									<td class="hide-on-med-and-down">'.$result3['area_wisata'].'</td>
									<td class="hide-on-med-and-down"><a class="modal-trigger waves-effect waves-light btn" style="padding: 0px 5px;" href="#preview'.$count++.'">Preview</a></td>
									<td>
										<form name="approver" action="modul/approve.php" method="POST">
											<input value='.$result3['id_wisata'].' type="hidden" name="verified">
											<button class="btn waves-effect waves-teal" type="submit">Approve</button>
										</form>
									</td>
									<td>
										<form name="disapprover" action="modul/disapprove.php" method="POST">
											<input value='.$result3['id_wisata'].' type="hidden" name="disapproved">
											<button class="btn waves-effect waves-teal" type="submit">Disapprove</button>
										</form>
									</td>
							</tr>';
						}
						echo '</tbody></table>';
					}
					else {
				?>
					<p class="center">Tidak ada Request baru</p>
				<?php 
					} 
				?>
			</center>
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