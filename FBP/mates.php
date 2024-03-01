<?php include("header.php");
function get_mates($conn,$mates){
	$getmates=sql_query($conn,"SELECT rtg,u.*,t.tid,tm.tname FROM uatts a JOIN umate u ON a.id=u.id JOIN uteam t ON t.id=u.id LEFT JOIN teams tm ON tm.tid=t.tid WHERE u.id IN (".$mates.")");
	while($row=mysqli_fetch_assoc($getmates)){$matesgotten="<tr>".'<td><a href="player?id='.$row['id'].'">'.$row['name'].'</a></td>'."<td>".$row['rtg']."</td>".'<td><a href="team?id='.$row['tid'].'">'.$row['tname'].'</a></td>'."</tr>";}
	if(!$row){$matesgotten='<tr><td colspan="3">None</td></tr>';}
	echo $matesgotten;
}
if(isset($_POST['smr'])&&strlen(handle_name($_POST['smr']))<17){
	// still need to find player and get id
	// update user
	//sql($conn,"UPDATE users SET sen="/* REQUESTS_SENT */" WHERE id=$uid");
	// update player
	//sql($conn,"UPDATE users SET cep="/* REQUESTS_RECEIVED */" WHERE id=$pid");
}else{echo "Player not found";}?>
<h1>Mates</h1>
<table class="table2" cellpadding="8" cellspacing="0">
	<tr><th width="224px">Team</td><th width="64px">RTG</td><th width="224px">Player</td></tr>
	<?php get_mates($conn,$mates);?>
	<!-- maybe javascript
	<tr>
		<th width="128px">Player</td>
		<th width="32px">Ø</td>
		<th width="48px">STR</td>
		<th width="48px">SPD</td>
		<th width="48px">SKL</td>
		<th width="48px">ATK</td>
		<th width="48px">DFS</td>
		<th width="128px">Team</td>
	</tr>
	<tr>
		<td>[Name]</td>
		<td style="background-color:green">5</td>
		<td style="background-color:teal">5</td>
		<td style="background-color:navy">5</td>
		<td style="background-color:purple">5</td>
		<td style="background-color:maroon">5</td>
		<td style="background-color:olive">5</td>
		<td>none</td>
	</tr>-->
</table>
<h2>Requests</h2>
<table class="table1" cellpadding="8" cellspacing="0">
	<tr><th>[Team]</th><th>Player</th></tr>
	<?php get_mates($conn,$cep);?>
</table>
<h2>Sent</h2>
<table class="table1" cellpadding="8" cellspacing="0">
	<tr><th>[Team]</th><th>Player</th></tr>
	<?php get_mates($conn,$sen);?>
</table>
<br /><form method="POST"><input type="text"name="smr"/><br /><input type="submit"value="Submit Request"></form>
<?php include("footer.php");?>