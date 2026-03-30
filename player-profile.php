<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_profile_functions;
	
	// Redirect if GET id was not given or is not valid.
	if ( ! isset( $_GET['id'] ) || ! INPUT_is_id_valid( $_GET['id'] ) ) REDIRECT('ranking-player');
	
	$_profile_id = $_GET['id'];
	
	$_profile = PLAYER_Profile_get( $_profile_id ) or REDIRECT('search-player');
	
	$_generic_atts = PLAYER_get_generic_attributes_from_player( $_profile );
	
	// Display player's team name or (no team).
	if ( ! $_profile['team_name'] ) $_profile['team_name'] = '(no team)';
	
	// Show frontend controls if player is logged in and is not viewing own profile.
	$_show_controls = $_IS_LOGGED_IN && $_profile_id != $_player_id;
	if ( $_show_controls )
	{
		$_mate_status = PLAYER_Profile_get_mate_status( $_profile_id ) or DIALOG_add_player_fail('could not determine whether these players are already mates');
		
		$_invite_status = PLAYER_Profile_get_invite_status() or DIALOG_add_player_fail('could not get invite status');
		
		$_show_button_play5_selection = PLAYER_Profile_is_play_5_selection_allowed() ?? DIALOG_add_player_fail('could not determine whether play-5 selection is allowed');
	}

?>

<?php require_once $_FILEREF_frontend_layout; ?>