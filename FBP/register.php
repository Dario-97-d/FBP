<?php
include("header.php");
/*
if(isset($_SESSION['fbpid'])){
	header("Location: overview");
}else{
	if(isset($_POST['register'])){
		$un = prot($conn, $_POST['un']);
		$pw = prot($conn, $_POST['pw']);
		$em = prot($conn, $_POST['em']);
		
		if($un == "" || $pw == "" || $em == ""){
			output("All fields are needed!");
		}elseif(strlen($un) > 16 || strlen($un) < 4){
			output("Username must be min. 4, max. 16 characters long.");
		}elseif(strlen($pw) > 32 || strlen($pw) < 8){
			output("Password must be min. 8, max. 32 characters long.");
		}elseif(strlen($em) > 48 || strlen($em) < 8){
			output("E-mail is either too short or too long. Please try again with another.");
		}else{
			$regun = mysqli_query($conn, "SELECT id FROM user WHERE username='$un'") or die(mysqli_error($conn));
			$regem = mysqli_query($conn, "SELECT id FROM user WHERE email='$em'") or die(mysqli_error($conn));
			if(mysqli_num_rows($regun) > 0){
				output("This username is already in use");
			}elseif(mysqli_num_rows($regem) > 0){
				output("This e-mail address is already in use");
			}else{
				$ins1 = mysqli_query($conn, "INSERT INTO users (username,password,email) VALUES ('$un','".md5($pw)."','$em')") or die(mysqli_error($conn));
				$ins2 = mysqli_query($conn, "INSERT INTO uatts (str,mov,skl,atk,dfs,rtg,tps) VALUES (2,2,2,4,2,2,11)") or die(mysqli_error($conn));
				$ins3 = mysqli_query($conn, "INSERT INTO umate (mates,cep,sen,block,allow) VALUES (0,0,0,0,0)") or die(mysqli_error($conn));
				$ins4 = sql_query($conn, "INSERT INTO uplay (speed,agili,airpl,energ,dribb,passe,shots,tackl,posit,visio,marki,previ) VALUES (1,1,1,1,1,1,1,1,1,1,1,1)");
				$ins5 = mysqli_query($conn, "INSERT INTO uteam (tid,trank,tinv) VALUES (0,'none',0)") or die(mysqli_error($conn));
				$ins6 = mysqli_query($conn, "INSERT INTO ustat (wins,matches,score) VALUES (0,0,0)") or die(mysqli_error($conn));
				$ins7 = mysqli_query($conn, "INSERT INTO ustam (stamina,stareg,maxsta) VALUES (100,5,100)") or die(mysqli_error($conn));
				$ins8 = mysqli_query($conn, "INSERT INTO upnts (level,exp) VALUES (1,0)") or die(mysqli_error($conn));
				header("Location: index");
			}
		}
	}else{
		header("Location: index");
	}
}
*/
include("footer.php");
?>