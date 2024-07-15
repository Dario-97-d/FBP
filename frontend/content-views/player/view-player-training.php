
<h1><?= $_player['player_name'] ?></h1>

<table class="table2" cellpadding="8">
	<tr>
		<th colspan="5">RTG: <?= $_player['rating'] ?></th>
	</tr>
	<tr>
		<td>STR</td>
		<td>MOV</td>
		<td>SKL</td>
		<td>ATK</td>
		<td>DFS</td>
	</tr>
	<?='<tr><td>' . $_player['strength'] . '</td><td>' . $_player['movement'] . '</td><td>' . $_player['skill'] . '</td><td>' . $_player['attacking'] . '</td><td>' . $_player['defending'] . '</td></tr>' ?>
	<tr>
		<form method="POST" onsubmit="return confirm('?')">
			<td><input type="submit" name="str" value="Train"></td>
			<td><input type="submit" name="mov" value="Train"></td>
			<td><input type="submit" name="skl" value="Train"></td>
			<td><input type="submit" name="atk" value="Train"></td>
			<td><input type="submit" name="dfs" value="Train"></td>
		</form>
	</tr>
	<tr>
		<th colspan="5"><?= $training_points = 'X' ?></th>
	</tr>
</table>

<br />
<hr color="purple" style="width:394px">
<br />

<table class="table1">
	<tr><th style="width:170px">Physical</th><th style="width:170px">Technical</th><th style="width:170px">Tactical</th></tr>
	<form action="train" method="POST" onsubmit="return confirm('?')">
		<tr>
			<td><?= ( $_player['movement'] > $_player['pace'] + $_player['agility'] ? '<a href="train?t=speed" name="speed">Speed</a>: ' . $_player['pace'] . ' (' . ( $_player['movement'] - ( $_player['pace'] + $_player['agility'] ) ) . ')' : 'Speed: ' . $_player['pace'] ) ?></td>
			<td><?= ( $_player['skill'] > $_player['dribbling'] + $_player['passing'] + $_player['shooting'] + $_player['tackling'] ? '<a href="train?t=dribb" name="dribb">Dribble</a>: ' . $_player['dribbling'] . ' (' . ( $_player['skill'] - ( $_player['dribbling'] + $_player['passing'] + $_player['shooting'] + $_player['tackling'] ) ) . ')' : 'Dribble: ' . $_player['dribbling'] ) ?></td>
			<td><?= ( $_player['attacking'] > $_player['opportunity'] + $_player['vision'] ? '<a href="train?t=posit" name="posit">Position</a>: ' . $_player['opportunity'] . ' (' . ( $_player['attacking'] - ( $_player['opportunity'] + $_player['vision'] ) ) . ')' : 'Position: ' . $_player['opportunity'] ) ?></td>
		</tr>
		<tr>
			<td><?= ( $_player['movement'] > $_player['pace'] + $_player['agility'] ? '<a href="train?t=agili" name="agili">Agility</a>: ' . $_player['agility'] . ' (' . ( $_player['movement'] - ( $_player['pace'] + $_player['agility'] ) ) . ')' : 'Agility: ' . $_player['agility'] ) ?></td>
			<td><?= ( $_player['skill'] > $_player['dribbling'] + $_player['passing'] + $_player['shooting'] + $_player['tackling'] ? '<a href="train?t=passe" name="passe">Pass</a>: ' . $_player['passing'] . ' (' . ( $_player['skill'] - ( $_player['dribbling'] + $_player['passing'] + $_player['shooting'] + $_player['tackling'] ) ) . ')' : 'Pass: ' . $_player['passing'] ) ?></td>
			<td><?= ( $_player['attacking'] > $_player['opportunity'] + $_player['vision'] ? '<a href="train?t=visio" name="visio">Vision</a>: ' . $_player['vision'] . ' (' . ( $_player['attacking'] - ( $_player['opportunity'] + $_player['vision'] ) ) . ')' : 'Vision: ' . $_player['vision'] ) ?></td>
		</tr>
		<tr>
			<td><?= ( $_player['strength'] > $_player['air_play'] + $_player['duels'] ? '<a href="train?t=airpl" name="airpl">Airplay</a>: ' . $_player['air_play'] . ' (' . ( $_player['strength'] - ( $_player['air_play'] + $_player['duels'] ) ) . ')' : 'Airplay: ' . $_player['air_play'] ) ?></td>
			<td><?= ( $_player['skill'] > $_player['dribbling'] + $_player['passing'] + $_player['shooting'] + $_player['tackling'] ? '<a href="train?t=shots" name="shots">Shot</a>: ' . $_player['shooting'] . ' (' . ( $_player['skill'] - ( $_player['dribbling'] + $_player['passing'] + $_player['shooting'] + $_player['tackling'] ) ) . ')' : 'Shot: ' . $_player['shooting'] ) ?></td>
			<td><?= ( $_player['defending'] > $_player['marking'] + $_player['positioning'] ? '<a href="train?t=marki" name="marki">Marking</a>: ' . $_player['marking'] . ' (' . ( $_player['defending'] - ( $_player['marking'] + $_player['positioning'] ) ) . ')' : 'Marking: ' . $_player['marking'] ) ?></td>
		</tr>
		<tr>
			<td><?= ( $_player['strength'] > $_player['air_play'] + $_player['duels'] ? '<a href="train?t=energ" name="energ">Energy</a>: ' . $_player['duels'] . ' (' . ( $_player['strength'] - ( $_player['air_play'] + $_player['duels'] ) ) . ')' : 'Energy: ' . $_player['duels'] ) ?></td>
			<td><?= ( $_player['skill'] > $_player['dribbling'] + $_player['passing'] + $_player['shooting'] + $_player['tackling'] ? '<a href="train?t=tackl" name="tackl">Tackle</a>: ' . $_player['tackling'] . ' (' . ( $_player['skill'] - ( $_player['dribbling'] + $_player['passing'] + $_player['shooting'] + $_player['tackling'] ) ) . ')' : 'Tackle: ' . $_player['tackling'] ) ?></td>
			<td><?= ( $_player['defending'] > $_player['marking'] + $_player['positioning'] ? '<a href="train?t=previ" name="previ">Prevision</a>: ' . $_player['positioning'] . ' (' . ( $_player['defending'] - ( $_player['marking'] + $_player['positioning'] ) ) . ')' : 'Prevision: ' . $_player['positioning'] ) ?></td>
		</tr>
	</form>
</table>