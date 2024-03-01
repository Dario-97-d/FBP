<?php include("header.php");
if($udata['tid']<1){exit(header("Location: createam"));}
else{
	$getteamname=sql_query($conn, "SELECT tname FROM teams WHERE tid=".$tid."");
	$teamname=mysqli_fetch_assoc($getteamname);
	echo "<h1>".$teamname['tname']."</h1>";
	?>
	<h2><a href="myteammng">Team Manager</a></h2>
	<table class="table1" cellpadding="8">
		<tr><th>Status</th><th>Players</th><th>Rating</th></tr>
		<?php $r=1;
		$getmembers=sql_query($conn, "SELECT rtg,name,t.* FROM uatts a JOIN umate u ON a.id=u.id JOIN uteam t ON t.id=u.id WHERE t.tid='".$udata['tid']."' ORDER BY trank");
		while($row=mysqli_fetch_assoc($getmembers)){echo "<tr><td>".$row['trank']."</td>".'<td><a href="player?id='.$row['id'].'">'.$row['name']."</a></td><td>".$row['rtg']."</td></tr>";}
		while($r<6){echo "<tr><td>-</td><td>-</td><td>-</td></tr>";$r++;}
		?>
	</table>
	<h2><a href="playfive">Play 5v5</a></h2>
<?php
}
include("footer.php");?>