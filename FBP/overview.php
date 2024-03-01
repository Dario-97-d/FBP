<?php include("header.php"); ?>
<h1>Overview</h1>
<h2><?php echo $name;?> | Lv <?php echo $rtg?></h2>
<table class="table2" cellpadding="8" cellspacing="0">
	<tr><th width="48px">STR</th><th width="48px">MOV</th><th width="48px">SKL</th><th width="48px">ATK</th><th width="48px">DFS</th></tr>
	<?php echo'<tr><td label="Strength">'.$str.'</td><td>'.$mov.'</td><td>'.$skl.'</td><td>'.$atk.'</td><td>'.$dfs.'</td></tr>';?>
</table>
<h2><a href="train">Train</a></h2>
<table class="table1">
	<tr><th style="width:170px">Physical</th><th style="width:170px">Technical</th><th style="width:170px">Tactical</th></tr>
	<tr><td>Speed: <?php echo $speed;?></td><td>Dribble: <?php echo $dribb;?></td><td>Position: <?php echo $posit;?></td></tr>
	<tr><td>Agility: <?php echo $agili;?></td><td>Pass: <?php echo $passe;?></td><td>Vision: <?php echo $visio;?></td></tr>
	<tr><td>Airplay: <?php echo $airpl;?></td><td>Shot: <?php echo $shots;?></td><td>Marking: <?php echo $marki;?></td></tr>
	<tr><td>Energy: <?php echo $energ;?></td><td>Tackle: <?php echo $tackl;?></td><td>Prevision: <?php echo $previ;?></td></tr>
</table>
<h3><a href="playthree">Practice</a></h3>
<?php include("footer.php"); ?>