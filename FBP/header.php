<html>
<head>
<title>FBP</title>
<link href="style3.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div align="center">
<div id="header"><a href="index"><b>FBP</b></a></div>
<?php
include("functions.php");
$uid = 1;
$getdata=sql_query($conn,"SELECT a.*,u.*,p.*,t.* FROM uatts a JOIN umate u ON a.id=u.id JOIN uplay p ON u.id=p.id JOIN uteam t ON u.id=t.id WHERE u.id=".$uid."");
extract($udata=mysqli_fetch_assoc($getdata));
?>
<hr color="purple">
<div id="content" class="content">
	<div class="top-bar">
		<a class="top-bar-link" href="teams">Teams</a>
		<a class="top-bar-link" href="players">Players</a>
		<a class="top-bar-link" href="overview">Overview</a>
		<a class="top-bar-link" href="myteam">MyTeam</a>
		<a class="top-bar-link" href="mates">Mates</a>
	</div>