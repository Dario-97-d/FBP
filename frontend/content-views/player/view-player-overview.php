
<h1>Overview</h1>

<h2><?= $_player['player_name'] ?> | &empty; <?= $_player['rating'] ?></h2>
@<?= $_player['username'] ?>

<table class="table2" cellpadding="8" cellspacing="0">
	<tr>
		<th width="48px">STR</th>
		<th width="48px">MOV</th>
		<th width="48px">SKL</th>
		<th width="48px">ATK</th>
		<th width="48px">DFS</th>
	</tr>
	<tr>
		<td><?= $_player['strength'] ?></td>
		<td><?= $_player['movement'] ?></td>
		<td><?= $_player['skill'] ?></td>
		<td><?= $_player['attacking'] ?></td>
		<td><?= $_player['defending'] ?></td>
	</tr>
</table>

<table class="table1">
	<tr>
		<th style="width:170px">Physical</th>
		<th style="width:170px">Technical</th>
		<th style="width:170px">Tactical</th>
	</tr>
	<tr>
		<td>Speed: <?= $_player['pace'] ?></td>
		<td>Dribble: <?= $_player['dribbling'] ?></td>
		<td>Position: <?= $_player['opportunity'] ?></td>
	</tr>
	<tr>
		<td>Agility: <?= $_player['agility'] ?></td>
		<td>Pass: <?= $_player['passing'] ?></td>
		<td>Vision: <?= $_player['vision'] ?></td>
	</tr>
	<tr>
		<td>Airplay: <?= $_player['air_play'] ?></td>
		<td>Shot: <?= $_player['shooting'] ?></td>
		<td>Marking: <?= $_player['marking'] ?></td>
	</tr>
	<tr>
		<td>Energy: <?= $_player['duels'] ?></td>
		<td>Tackle: <?= $_player['tackling'] ?></td>
		<td>Prevision: <?= $_player['positioning'] ?></td>
	</tr>
</table>

