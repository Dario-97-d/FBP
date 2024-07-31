<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	
	// Redirect if GET id was not given or is not valid.
	if ( ! isset( $_GET['partner-id'] ) || ! INPUT_is_id_valid( $_GET['partner-id'] ) ) REDIRECT('ranking-player');
	
	$_partner_id = $_GET['partner-id'];
	
	$_player = PLAYER_get_generic_play_profile( $_player_id ) or DIE_error();
	
	$_partner = PLAYER_get_generic_play_profile( $_partner_id ) or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>