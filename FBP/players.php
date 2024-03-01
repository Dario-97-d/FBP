<?php include("header.php");?>
<h1>Players</h1>
<table class="table2" cellpadding="8" cellspacing="0">
	<tr><th width="64px">Rank</td><th width="256px">Name</td><th width="64px">RTG</td></tr>
	<?php $getplayers=mysqli_query($conn,"SELECT u.id,rtg,name FROM uatts a JOIN umate u ON a.id=u.id ORDER BY rtg DESC LIMIT 50") or die(mysqli_error($conn));$r = 1;
	while($row = mysqli_fetch_assoc($getplayers)){
		echo "<tr><td>".$r."</td>";
		echo '<td><a href="player?id='.$row['id'].'">'.$row['name'].'</a></td>';
		echo "<td>".$row['rtg']."</td></tr>";$r++;
	}
	?>
	<!-- javascript
	<tr>
		<th width="32px">Rank</td>
		<th width="128px">Player</td>
		<th width="32px">Ø</td>
		<th width="48px">STR</td>
		<th width="48px">MOV</td>
		<th width="48px">SKL</td>
		<th width="48px">ATK</td>
		<th width="48px">DFS</td>
		<th width="128px">Club</td>
	</tr>
	<tr>
		<td>1</td>
		<td>[Name]</td>
		<td style="background:green">5</td>
		<td style="background:teal">5</td>
		<td style="background:navy">5</td>
		<td style="background:purple">5</td>
		<td style="background:maroon">5</td>
		<td style="background:olive">5</td>
		<td>none</td>
	</tr>-->
</table>
<?php include("footer.php");?>