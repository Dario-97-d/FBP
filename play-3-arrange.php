<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	
	// Get Player's generic playing attributes.
	$_player = PLAYER_get_generic_play_profile( $_player_id ) or DIE_error();
	
	// Check whether a partner id was given.
	if ( isset( $_GET['id'] ) )
	{
		$_partner_id = $_GET['id'];
		
		// Get Partner's generic playing attributes.
		$_partner = PLAYER_get_generic_play_profile( $_partner_id ) or DIE_error();
	}

?>

<?php require_once $_FILEREF_frontend_layout; ?>