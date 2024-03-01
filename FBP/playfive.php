<?php include("header.php"); ?>
<h1>Choose teammates</h1>
<form action="" method="get">
	<table class="table2" cellpadding="8" cellspacing="0">
		<tr>
			<th width="128px">Player</th>
			<th width="32px">Ø</th>
			<th width="48px">STR</th>
			<th width="48px">MOV</th>
			<th width="48px">SKL</th>
			<th width="48px">ATK</th>
			<th width="48px">DFS</th>
			<th></th>
		</tr>
		<tr>
			<td>[Name]</td>
			<td style="background-color:green">5</td>
			<td style="background-color:teal">5</td>
			<td style="background-color:navy">5</td>
			<td style="background-color:purple">5</td>
			<td style="background-color:maroon">5</td>
			<td style="background-color:olive">5</td>
			<td><input type="checkbox" value="player_id"></td>
		</tr>
	</table>
	<input type="submit" value="Submit">
</form>
<?php include("footer.php"); ?>