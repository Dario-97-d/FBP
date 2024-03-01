<?php include("header.php");?>
<h1>Teams</h1>
<table class="table2"style="width:512px;"cellpadding="8"cellspacing="0">
	<tr><th width="64px">Rank</td><th width="64px">Class</td><th width="128px">Team</td><th width="64px">Members</td><th width="64px">RTG</td></tr>
	<?php $getteams=mysqli_query($conn,"SELECT * FROM teams ORDER BY trtg DESC LIMIT 50") or die(mysqli_error($conn));
	$r=1;while($row=mysqli_fetch_assoc($getteams)){
		echo
		"<tr><td>".$r."</td><td>".$row['class']."</td>".
		'<td><a href="team?id='.$row['tid'].'">'.$row['tname'].'</a></td>'.
		"<td>".$row['members']."</td><td>".$row['trtg']."</td></tr>";
		$r++;
	}while($r<11){echo "<tr><td>$r</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>";$r++;}
	?>
</table>
<br /><form method="POST"><input type="text"name="findteam"<?php echo (isset($findteam)?'value="'.$team.'"':'');?>/><br /><input type="submit"value="Search Team"></form>
<?php include("footer.php");?>