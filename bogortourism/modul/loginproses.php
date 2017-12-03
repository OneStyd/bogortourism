<?php
	include 'connect.php';
	
	$email = $_POST['emailogin'];
	$password = $_POST['passlogin'];
	
	$proces = $conn->prepare("SELECT id_member, pass_member FROM member WHERE email_member = ? LIMIT 1");
	
	$proces->bind_param("s", $email);
	$proces->execute();
	$proces->store_result();
	
	$proces->bind_result($user, $db_password);
	$proces->fetch();
	
	if($proces->num_rows==1){
		if ($db_password == $password){
			$_SESSION['id'] = $user;
			if($_SESSION['id'] == '1'){
				$_SESSION['status'] = "Admin";
?>
				<script language="javascript">alert("Welcome Back Master");</script>
				<script> document.location.href='../dashboard.php';</script>
<?php
			}
			else {
				$_SESSION['status'] = "user";
?>
				<script language="javascript">alert("Logging Succesful");</script>
				<script> document.location.href='../profile.php';</script>
<?php		
			}
		}	
		else { 
?>
			<script language="javascript">alert("Wrong Password");</script>
			<script>document.location.href='../login.php';</script>
<?php 
		}	
	}
	else {
?>
		<script language="javascript">alert("Wrong Email or Password");</script>
		<script>document.location.href='../login.php';</script>
<?php
	}
	mysqli_close($conn);
?>