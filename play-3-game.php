<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	require_once $_FILEREF_play_3_functions;
	
	// This page is meant to work only on POST['id'] requests.
	
	// Redirect if id was not given.
	if ( ! isset( $_POST['partner-id'] ) ) REDIRECT('play-3-arrange');
	
	// Redirect if id given *is not* valid.
	if ( ! INPUT_is_id_valid( $_POST['partner-id'] ) ) REDIRECT('play-3-arrange');
	
	// Redirect if player is trying to play with himself.
	if ( $_POST['partner-id'] == $_player_id ) REDIRECT('play-3-arrange');

	
	$_partner_id = $_POST['partner-id'];
	
	
	$_player = PLAYER_get_play_3_data( $_player_id ) or DIE_error();
	
	$_partner = PLAYER_get_play_3_data( $_partner_id ) or DIE_error();
	
	
	$_result = PLAY_3( $_player, $_partner );
	
	PLAYER_update_on_play_3_result( $_result ) or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>