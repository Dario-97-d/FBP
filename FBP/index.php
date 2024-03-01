<?php include("header.php");
/*
if(isset($_POST['login'])){
	if(isset($_SESSION['uid'])){exit(header("Location: overview"));}
	$un = handle_name($_POST['un']);
	$pw = handle_pw($_POST['pw']);
	$login_check = sql_query($conn, "SELECT id FROM user WHERE username='$un' AND password='".md5($pw)."'");
	if(mysqli_num_rows($login_check) != 1){echo "Invalid Username-Password Combination!";
	}else{
		$login_id = mysqli_fetch_assoc($login_check);
		$_SESSION['uid'] = $login_id['id'];
		exit(header("Location: overview"));
	}
}
if(!isset($_SESSION['uid'])){
	*/
	?>
	<!--
	<form action="index.php" method="POST">
		<b>Login:</b>
		<input type="text" name="un" value="Username"/>
		<input type="password" name="pw" value="Password"/>
		<input type="submit" class="button1" name="login" value="Login"/>
	</form>
	-->
	<h1>Register</h1>
		<form action="register.php" method="POST">
			Username: <br /><input type="text" name="un"/><br />
			Password: <br /><input type="password" name="pw"/><br />
			E-mail: <br /><input type="email" name="em"/><br />
			<br /><input type="submit" class="button1" name="register" value="Register"/>
		</form>
	<?php
	/*
}
*/
include("footer.php");?>