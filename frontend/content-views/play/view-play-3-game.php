
<h1>Practice 3v3</h1>

<table class="table2" id="table2-qmatch" cellpadding="8" cellspacing="0">
	<tr>
		<th><?= $_player['player_name'] ?></th>
		<th><?= $_partner['player_name'] ?></th>
		<th>vs</th>
		<th>Bot1</th>
		<th>Bot2</th>
	</tr>
	<tr>
		<td><?= $_player['rating'] ?></td>
		<td><?= $_partner['rating'] ?></td>
		<td>RTG</td>
		<td><?= $b1_rating ?></td>
		<td><?= $b2_rating ?></td>
	</tr>
	<tr>
		<td><?= $_player['skill'] ?></td>
		<td><?= $_partner['skill'] ?></td>
		<td>SKL</td>
		<td><?= $b1_skill ?></td>
		<td><?= $b2_skill ?></td>
	</tr>
	<tr>
		<td><?= $_player['performance'] ?></td>
		<td><?= $_partner['performance'] ?></td>
		<td>Performance</td>
		<td><?= $b1_performance ?></td>
		<td><?= $b2_performance ?></td>
	</tr>
	<tr>
		<td colspan="2"><?= $p_result ?></td>
		<td>Result</td>
		<td colspan="2"><?= $b_result ?></td>
	</tr>
	<tr>
		<td colspan="5" style="background: limegreen;"></td>
	</tr>
</table>