<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	
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
	
	// TODO: Make game 3v3
	
	// -- Make up values for frontend --
	
	$_player['performance'] = round ( 10 * sqrt( $_player['rating'] * $_partner['skill'] ) );
	$_partner['performance'] = round ( 10 * sqrt( $_partner['rating'] * $_player['skill'] ) );
	
	$b1_rating = ceil( ( $_player['rating'] + $_partner['rating'] ) / 2 );
	$b2_rating = floor( ( $_player['rating'] + $_partner['rating'] ) / 2 );
	$b1_skill = floor( ( $_player['skill'] + $_partner['skill'] ) / 2 );
	$b2_skill = ceil( ( $_player['skill'] + $_partner['skill'] ) / 2 );
	
	$b1_performance = round ( 10 * sqrt( $b1_rating * $b2_skill ) );
	$b2_performance = round ( 10 * sqrt( $b2_rating * $b1_skill ) );
	
	$p_result = round( 30 * ( $_player['skill'] * $_partner['skill'] ) / ( $b1_rating * $b2_rating ) );
	$b_result = round( 30 * ( $b1_skill * $b2_skill ) / ( $_player['rating'] * $_partner['rating'] ) );

?>

<?php require_once $_FILEREF_frontend_layout; ?>