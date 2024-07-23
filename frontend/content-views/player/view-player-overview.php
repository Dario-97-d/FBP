
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
		<td>Speed: <?=     $_player['speed'] ?></td>
		<td>Dribble: <?=   $_player['dribble'] ?></td>
		<td>Position: <?=  $_player['position'] ?></td>
	</tr>
	<tr>
		<td>Agility: <?=   $_player['agility'] ?></td>
		<td>Pass: <?=      $_player['pass'] ?></td>
		<td>Vision: <?=    $_player['vision'] ?></td>
	</tr>
	<tr>
		<td>Airplay: <?=   $_player['airplay'] ?></td>
		<td>Shoot: <?=     $_player['shoot'] ?></td>
		<td>Prevision: <?= $_player['prevision'] ?></td>
	</tr>
	<tr>
		<td>Power: <?=     $_player['power'] ?></td>
		<td>Tackle: <?=    $_player['tackle'] ?></td>
		<td>Marking: <?=   $_player['marking'] ?></td>
	</tr>
</table>

<h3><a href="player-development">Train</a></h3>