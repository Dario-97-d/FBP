<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	
	$_players = PLAYER_get_rankings() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>