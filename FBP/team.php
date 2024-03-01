<?php include("header.php");
$tid = $_GET['id'];
// KEEP DATABASE SAFE !!! (prep statements) or function handle_id
$getteamname=sql_query($conn,"SELECT tname FROM teams WHERE tid=".$tid."");
$teamname=mysqli_fetch_assoc($getteamname);
?>
<h1><?php echo $teamname['tname']?></h1>
<table class="table1" cellpadding="8">
	<tr><th>Status</th><th>Players</th><th>Rating</th></tr>
	<?php $r=1;
	// KEEP DATABASE SAFE !!! (prep statements)
	$getmembers=sql_query($conn,"SELECT rtg,name,t.* FROM uatts a JOIN umate u ON a.id=u.id JOIN uteam t ON t.id=u.id WHERE t.tid=".$tid." ORDER BY rtg LIMIT 50");
	while($row=mysqli_fetch_assoc($getmembers)){$r++;echo '<tr><td>'.$row['trank'].'</td><td><a href="player?id='.$row['id'].'">'.$row['name'].'</a></td><td>'.$row['rtg'].'</td></tr>';}
	while($r<6){echo "<tr><td>-</td><td>-</td><td>-</td></tr>";$r++;}?>
</table>
<h3><a href="playfive">Play 5v5</a></h3>
<?php include("footer.php");?>