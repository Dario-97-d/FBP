<?php include("header.php");
// Train
if($stat=array_search('Train',$_POST)){ // $_POST['stat'] == 'Train'
	if(in_array($stat,array('str','mov','skl','atk','dfs'))){
		//check training points
		($stat=='skl'?$tps-=2:$tps-=1);
		if($tps<0){echo "Not enough Training Points";$tps=$udata['tps'];}
		else{
			$$stat+=1;
			//check rating change
			if($rtg<ceil(($str+$mov+$skl+$atk+$dfs)/5)){$rtg+=1;update($conn,"teams","trtg=trtg+1","tid=".$tid."");}
			update($conn,"stats","".$stat."=".$stat."+1,rtg=".$rtg.",tps=".$tps."","id=".$uid."");
		}
	}else{echo "Hello";}
}
$speed=$agili=1;
?>
<h1><a href="train">Train</a></h1>
<table class="table2" cellpadding="8">
	<tr><th colspan="5">RTG: <?php echo $rtg;?></th></tr>
	<tr><td>STR</td><td>MOV</td><td>SKL</td><td>ATK</td><td>DFS</td></tr>
	<?php echo'<tr><td>'.$str.'</td><td>'.$mov.'</td><td>'.$skl.'</td><td>'.$atk.'</td><td>'.$dfs.'</td></tr>';?>
	<tr><form action="train" method="POST">
		<td><input type="submit" name="str" value="Train"></td>
		<td><input type="submit" name="mov" value="Train"></td>
		<td><input type="submit" name="skl" value="Train"></td>
		<td><input type="submit" name="atk" value="Train"></td>
		<td><input type="submit" name="dfs" value="Train"></td>
	</form></tr>
	<tr><th colspan="5"><?php echo $tps;?></th></tr>
</table>
<br /><hr color="purple" style="width:394px"><br />
<table class="table1">
	<tr><th style="width:170px">Physical</th><th style="width:170px">Technical</th><th style="width:170px">Tactical</th></tr>
	<form action="train" method="POST">
		<tr>
			<td><?php echo ($mov>$speed+$agili?'<a href="train?t=speed" name="speed">Speed</a>: '.$speed.' ('.($mov-($speed+$agili)).')':'Speed: '.$speed);?></td>
			<td><?php echo ($skl>$dribb+$passe+$shots+$tackl?'<a href="train?t=dribb" name="dribb">Dribble</a>: '.$dribb.' ('.($skl-($dribb+$passe+$shots+$tackl)).')':'Dribble: '.$dribb);?></td>
			<td><?php echo ($atk>$posit+$visio?'<a href="train?t=posit" name="posit">Position</a>: '.$posit.' ('.($atk-($posit+$visio)).')':'Position: '.$posit);?></td>
		</tr>
		<tr>
			<td><?php echo ($mov>$speed+$agili?'<a href="train?t=agili" name="agili">Agility</a>: '.$agili.' ('.($mov-($speed+$agili)).')':'Agility: '.$agili);?></td>
			<td><?php echo ($skl>$dribb+$passe+$shots+$tackl?'<a href="train?t=passe" name="passe">Pass</a>: '.$passe.' ('.($skl-($dribb+$passe+$shots+$tackl)).')':'Pass: '.$passe);?></td>
			<td><?php echo ($atk>$posit+$visio?'<a href="train?t=visio" name="visio">Vision</a>: '.$visio.' ('.($atk-($posit+$visio)).')':'Vision: '.$visio);?></td>
		</tr>
		<tr>
			<td><?php echo ($str>$airpl+$energ?'<a href="train?t=airpl" name="airpl">Airplay</a>: '.$airpl.' ('.($str-($airpl+$energ)).')':'Airplay: '.$airpl);?></td>
			<td><?php echo ($skl>$dribb+$passe+$shots+$tackl?'<a href="train?t=shots" name="shots">Shot</a>: '.$shots.' ('.($skl-($dribb+$passe+$shots+$tackl)).')':'Shot: '.$shots);?></td>
			<td><?php echo ($dfs>$marki+$previ?'<a href="train?t=marki" name="marki">Marking</a>: '.$marki.' ('.($dfs-($marki+$previ)).')':'Marking: '.$marki);?></td>
		</tr>
		<tr>
			<td><?php echo ($str>$airpl+$energ?'<a href="train?t=energ" name="energ">Energy</a>: '.$energ.' ('.($str-($airpl+$energ)).')':'Energy: '.$energ);?></td>
			<td><?php echo ($skl>$dribb+$passe+$shots+$tackl?'<a href="train?t=tackl" name="tackl">Tackle</a>: '.$tackl.' ('.($skl-($dribb+$passe+$shots+$tackl)).')':'Tackle: '.$tackl);?></td>
			<td><?php echo ($dfs>$marki+$previ?'<a href="train?t=previ" name="previ">Prevision</a>: '.$previ.' ('.($dfs-($marki+$previ)).')':'Prevision: '.$previ);?></td>
		</tr>
	</form>
</table>
<br /><a href="overview">Back</a>
<?php include("footer.php");?>