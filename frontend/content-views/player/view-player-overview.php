
<h1>Overview</h1>

<h2><?= $_player['player_name'] ?></h2>
@<?= $_player['username'] ?>

<?php
	// Partial View: Generic Attributes.
	require_once $_FILEREF_partial_view_generic_attributes;
?>

<div class="display-playing-attributes">
	
	<!-- Header -->
	<div class="display-playing-attributes-header">Physical</div>
	<div class="display-playing-attributes-header">Technical</div>
	<div class="display-playing-attributes-header">Tactical</div>
	
	<!-- Body -->
	
	<!-- Physical -->
	<div class="display-playing-attributes-body">
		<div>Speed</div><div><?=     $_player['speed']     ?></div>
		<div>Agility</div><div><?=   $_player['agility']   ?></div>
		<div>Airplay</div><div><?=   $_player['airplay']   ?></div>
		<div>Power</div><div><?=     $_player['power']     ?></div>
	</div>
	
	<!-- Technical -->
	<div class="display-playing-attributes-body">
		<div>Dribble</div><div><?=   $_player['dribble']   ?></div>
		<div>Pass</div><div><?=      $_player['pass']      ?></div>
		<div>Shoot</div><div><?=     $_player['shoot']     ?></div>
		<div>Tackle</div><div><?=    $_player['tackle']    ?></div>
	</div>
	
	<!-- Tactical -->
	<div class="display-playing-attributes-body">
		<div>Position</div><div><?=  $_player['position']  ?></div>
		<div>Vision</div><div><?=    $_player['vision']    ?></div>
		<div>Prevision</div><div><?= $_player['prevision'] ?></div>
		<div>Marking</div><div><?=   $_player['marking']   ?></div>
	</div>
	
</div>

<h3><a href="player-development">Development</a></h3>