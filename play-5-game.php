<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_play_5_game_functions;
	
	/*
	This page is meant to work only on POST['id'] requests.
	*/
	
	// Redirect if request is not POST['play-5'].
	if ( ! isset( $_POST['play-5'] ) ) REDIRECT('play-5-arrange');
	
	
	$_player = PLAY_5_get_player() or DIE_error();
	
	// Includes Bots.
	$_selected_players = PLAY_5_get_selected_players( $_player ) or DIE_error();
	
	// Exit if there aren't enough players selected.
	if ( count( $_selected_players ) !== 5 ) REDIRECT('play-5-arrange');
	
	$_total_atts = PLAY_5_get_total_atts( $_selected_players ) or DIE_error();
	
	$_result = PLAY_5_Game( $_selected_players, $_total_atts );
	
	PLAY_5_Game_update_player_on_result( $_result ) or DIE_error();
	
	PLAY_5_clear_selection() or DIALOG('could not clear selection');
	
	$_positions_players = $_result['positions_players'];
	$_positions_bots    = $_result['positions_bots'];

?>

<?php require_once $_FILEREF_frontend_layout; ?>