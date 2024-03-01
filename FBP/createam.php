<?php include("header.php");
if(isset($_POST['newteam'])&&$udata['tid']<1){
	$newteam=handle_name($_POST['newteamname']);
	if(strlen($newteam)>16){echo $newteam;}
	// KEEP DATABASE SAFE !!! (prep statements)
	else{
		$checkteam=sql_query($conn,"SELECT id FROM teams WHERE name='".$newteam."'");
		if(mysqli_num_rows($checkteam)>0){
			echo "Team name already in use";
		}else{
			$inserteam=sql_query($conn,"INSERT INTO teams (tname,lastchange,class,rtg,members) VALUES ('".$newteam."','0','5','".$udata['rtg']."','1')");
			$getnewtid=sql_query($conn,"SELECT id FROM teams WHERE name='".$newteam."'");
			$newtid=mysqli_fetch_assoc($getnewtid);
			$teamfounder=sql_query($conn,"UPDATE uteam SET tid='".$newtid['id']."', trank='Admin' WHERE id=".$_SESSION['uid']."");
			exit(header("Location: myteam"));
		}
	}
}
?>
<h1>Team</h1>
<h2><a href="teams">Find Team</a></h2>
OR
<h2>Create Team</h2>
<form action="createam" method="POST">
	Team Name (4-16 chs): <br /><input type="text" name="newteamname"/>
	<br /><br />
	<input type="submit" name="newteam" value="Start Team"/>
</form>
<?php include("footer.php");?>