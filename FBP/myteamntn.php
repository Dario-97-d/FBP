<?php include("header.php");
if(isset($_SESSION['uid'])){exit(header("Location: index"));}
if($udata['trank'] != 'Admin'){exit(header("Location: myteam"));}

// get team name
$teamname = mysqli_fetch_assoc(sql_query($conn,"SELECT tname FROM teams WHERE tid=".$tid.""));
$tname = $teamname['tname'];

if(isset($_POST['newteamname'])){
	// check last change
	$lastchange = mysqli_fetch_assoc(sql_query($conn, "SELECT lastchange FROM teams WHERE tid=".$tid.""));
	if(time()<($nxtchg = $lastchange['lastchange']+604800)){echo "Team name changeable only once a week<br />Next change possible: ".date('d-m H:i',$nxtchg);}
	else{
		// handle newteamname
		$ntn = handle_name($_POST['newteamname']);
		// check error from handle_name function
		if(strlen($ntn) > 16){echo $ntn;}
		else{
			// check current team names
			$teamname = sql_query($conn, "SELECT tid FROM teams WHERE tname='".$ntn."'");
			if(mysqli_num_rows($teamname)>0){echo "This team name is already in use";}
			else{
				//update team name
				sql_query($conn, "UPDATE teams SET tname='".$ntn."',lastchange=".time()." WHERE tid=".$tid."");
				echo "New team name: $ntn<br />Next change possible: ".date('d-m H:i',$nxtchg);
				$tname=$ntn;
			}
		}
	}
}
?>
<h1>Team Name Changer</h1>
<h2><?php echo $tname?></h2>
<form action="myteamntn" method="POST">
	<div class="input"><input type="text" name="newteamname" value="New Team Name"/></div>
	<div class="input"><input type="submit" class="button1" value="Submit"/></div>
</form>
<a href="myteammng">Back</a>
<?php include("footer.php");?>