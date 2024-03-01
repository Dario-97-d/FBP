<?php include("header.php");if($rtg>19){exit(header("Location: overview"));}
if(isset($_POST['three'])){
	$three=handle_name($_POST['three']);
	if(strlen($three)<17){
		$p_id=sql_query($conn,"SELECT id FROM umate WHERE name='".$three."'");
		if((mysqli_num_rows($p_id))==1){extract($three_id=mysqli_fetch_assoc($p_id),EXTR_PREFIX_ALL,'p');if($p_id!=$uid){$pid=$p_id;}}
	}
}elseif(isset($_GET['id'])&&ctype_digit($_GET['id'])&&$_GET['id']!=$uid){$pid=$_GET['id'];}
if(isset($pid)){
	$player=sql_query($conn,"SELECT rtg,name FROM uatts a JOIN umate u ON a.id=u.id WHERE u.id=".$pid."");
	if(mysqli_num_rows($player)==1){
		extract($pdata=mysqli_fetch_assoc($player),EXTR_PREFIX_ALL,"p");
		$b1=' - '.ceil(($rtg+$p_rtg)/2);$b2=' - '.floor(($rtg+$p_rtg)/2);$playthree=1;
	}else{echo "Player not found.";$p_name="-";$rtg=$p_rtg=$b1=$b2=$playthree='';}
}else{$p_name="-";$rtg=$p_rtg=$b1=$b2=$playthree='';}
?>
<h1>3-a-side</h1>
<p>3-a-side is a Practice mode to develop initial traits, up to 20 Ø</p>
<table class="table1" cellpadding="8" cellspacing="0">
	<tr><th>Team</th><th>Ø</th><th>Bots</th></tr>
	<tr><td><?php echo $name;?></td><td><?php echo $rtg.$b1;?></td><td>Bot1</td></tr>
	<tr><td><?php echo $p_name;?></td><td><?php echo $p_rtg.$b2;?></td><td>Bot2</td></tr>
	<tr><td>GK</td><td>Bots</td><td>GK</td></tr>
	<?php if($playthree==1){echo '<tr><th colspan="3"><a href="three?id='.$pid.'">Play 3v3</a></th></tr>';}?>
</table>
<br /><form method="POST"><input type="text"name="three"<?php echo (isset($three)?'value="'.$three.'"':'');?>/><br /><input type="submit"value="Search Player"></form>
<table class="table2" cellpadding="8" cellspacing="0">
	<tr><th width="64px">RTG</th><th width="256px">Player</th><th width="64px">Select</th></tr>
	<?php $getplayers=sql_query($conn,"SELECT u.id,rtg,name FROM uatts a JOIN umate u ON a.id=u.id WHERE u.id<>".$uid." ORDER BY id DESC LIMIT 25");
	while($row=mysqli_fetch_assoc($getplayers)){
		echo "<tr><td>".$row['rtg']."</td>";
		echo '<td><a href="player?id='.$row['id'].'">'.$row['name'].'</a></td>';
		echo '<td><a href="playthree?id='.$row['id'].'">3v3</td></tr>';
	}?>
</table>
<a href="overview">Back</a>
<?php include("footer.php"); ?>