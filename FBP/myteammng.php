<?php include("header.php");
if(isset($_SESSION['uid'])){exit(header("Location: index"));}
if($udata['trank']!='Admin'){exit(header("Location: myteam"));}
// get team name
$teamname=mysqli_fetch_assoc(sql_query($conn,"SELECT tname FROM teams WHERE tid=".$tid.""));$ntn=$teamname['tname'];
?>
<h1>Team Manager</h1>
<h2><a href="myteamntn"><?php echo $ntn?></a></h2>
<h2>Admin Members</h2>
<table class="table1" cellpadding="8">
	<tr><th>Status</th><th>Players</th><th>Rating</th></tr>
	<?php
	$getmembers=sql_query($conn, "SELECT rtg,name,t.* FROM uatts a JOIN umate u ON a.id=u.id JOIN uteam t ON t.id=u.id WHERE t.tid='".$udata['tid']."' ORDER BY trank DESC");
	// get members names for array in admin members section
	$members=array();
	while($row=mysqli_fetch_assoc($getmembers)){echo "<tr><td>".$row['trank']."</td>".'<td><a href="player?id='.$row['id'].'">'.$row['name']."</a></td>"."<td>".$row['rtg']."</td></tr>"; $members[]=$row['name'];}
	?>
</table>
<h2>Set member as:</h2>
<form action="myteammng" method="POST">
	<select name="player">
		<option hidden="true">Select Member</option>
		<?php foreach($members as $member){echo "<option>".$member."</option>";}?>
	</select>
	<select name="rank">
		<option hidden="true">Select Action</option>
		<option>Admin</option>
		<option>Joueur</option>
		<option>Member</option>
		<option>Temp</option>
		<option>Dismiss</option>
	</select>
	<br />
	<div style="padding: 8px 0 0 0">
	<input type="submit" class="button1" value="Set"/>
	</div>
</form>
<h3>Reqs to become a club</h3>
<p>13 players rated 20+ must accept to stay in the club for 1 season</p>
<p></p>
<p></p>
<a href="myteam">Back</a>
<?php include("footer.php");?>