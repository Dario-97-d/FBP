
<h1>Overview</h1>

<h2><?= $_player['player_name'] ?> | &empty; <?= $_player['rating'] ?></h2>
@<?= $_player['username'] ?>

<?php
	// Partial View: Generic Attributes.
	require_once $_FILEREF_partial_view_generic_attributes;
?>

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