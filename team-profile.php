<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_functions;
	
	// Redirect if GET id was not given or is not valid.
	if ( ! isset( $_GET['id'] ) || ! INPUT_is_id_valid( $_GET['id'] ) ) REDIRECT('ranking-team');
	
	$_profile_id = $_GET['id'];
	
	$_profile = TEAM_get_profile( $_profile_id ) or REDIRECT('search-team');
	
	$_team_members = TEAM_get_profile_members( $_profile_id ) or DIE_error();
	
	if ( $_IS_LOGGED_IN )
	{
		$_player_team_status = TEAM_get_player_team_status() or DIALOG_add_team_fail('could not get player-team status');
	}

?>

<?php require_once $_FILEREF_frontend_layout; ?>