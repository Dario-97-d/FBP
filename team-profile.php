<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	require_once $_FILEREF_team_functions;
	
	// Redirect if GET id was not given or is not valid.
	if ( ! isset( $_GET['id'] ) || ! INPUT_is_id_valid( $_GET['id'] ) ) REDIRECT('ranking-team');
	
	// Get id given for Team profile.
	$_team_id = $_GET['id'];
	
	// Get team info.
	$_team_info = TEAM_get_info() or REDIRECT('search-team');
	
	// Get team members.
	$_team_members = TEAM_get_members() or DIE_error();
	
	
	if ( $_IS_LOGGED_IN )
	{
		$_player_team_status = TEAM_get_player_team_status() or DIALOG_add_team_fail('could not get player-team status');
	}

?>

<?php require_once $_FILEREF_frontend_layout; ?>