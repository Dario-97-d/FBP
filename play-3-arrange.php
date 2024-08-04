<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_play_3_functions;
	
	// Redirect if GET id was not given or is not valid.
	if ( ! isset( $_GET['partner-id'] ) || ! INPUT_is_id_valid( $_GET['partner-id'] ) ) REDIRECT('ranking-player');
	
	$_partner_id = $_GET['partner-id'];
	
	$_player = PLAY_3_get_player( $_player_id ) or DIE_error();
	
	$_partner = PLAY_3_get_player( $_partner_id ) or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>