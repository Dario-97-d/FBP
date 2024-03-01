<html>
<head><title>FBTP</title><link href="style"rel="stylesheet"type="text/css"/></head>
<body>
<?php
include("functions.php");
$getdata=sql_query($conn,"SELECT a.*,u.*,p.*,t.* FROM uatts a JOIN umate u ON a.id=u.id JOIN uplay p ON u.id=p.id JOIN uteam t ON u.id=t.id WHERE u.id='1'");
extract($udata=mysqli_fetch_assoc($getdata));$uid=$id;

$tid=1;//$_GET['id'];
// KEEP DATABASE SAFE !!! (prep statements) or function handle_id
$getteamname=sql_query($conn,"SELECT tname FROM teams WHERE tid=".$tid."");
$teamname=mysqli_fetch_assoc($getteamname);
?>
<div id="game-name">Football<br />Team Player</div>
<table class="players" cellpadding="8">
	<tr><th>RTG</th><th>Name</th><th>STR</th><th>MOV</th><th>SKL</th><th>ATK</th><th>DFS</th></tr>
	<?php
	$getmembers=sql_query($conn,"SELECT a.*,name,t.* FROM uatts a JOIN umate u ON a.id=u.id JOIN uteam t ON t.id=u.id WHERE t.tid=".$tid." ORDER BY rtg LIMIT 25");
	while($row=mysqli_fetch_assoc($getmembers)){echo '<tr><td>'.$row['rtg'].'</td><td><a href="player?id='.$row['id'].'">'.$row['name'].'</a></td><td>'.$row['str'].'</td><td>'.$row['mov'].'</td><td>'.$row['skl'].'</td><td>'.$row['atk'].'</td><td>'.$row['dfs'].'</td></tr>';}
	?>
</table>
<?php echo '';?>
</body>
</html>