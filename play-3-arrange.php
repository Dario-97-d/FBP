<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	
	// Redirect if GET id was not given or is not valid.
	if ( ! isset( $_GET['partner-id'] ) || ! INPUT_is_id_valid( $_GET['partner-id'] ) ) REDIRECT('ranking-player');
	
	$_partner_id = $_GET['partner-id'];
	
	$_partner = PLAYER_get_generic_play_profile( $_partner_id ) or DIE_error();
	
	$_generic_atts = PLAYER_get_generic_attributes_from_player( $_partner );

?>

<?php require_once $_FILEREF_frontend_layout; ?>