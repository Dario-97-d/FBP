<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_manage_name_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Check whether player is allowed to manage the team.
	if ( ! ( TEAM_Manage_is_player_allowed() ?? false ) ) REDIRECT('team-overview');
	
	
	// -- Change Team Name --
	if ( isset( $_POST['new-team-name'] ) )
	{
		$update_team_name = TEAM_Manage_Name_update( $_POST['new-team-name'] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $update_team_name ) ) REDIRECT('team-overview');
		
		// Display failure message.
		DIALOG_add_result( $update_team_name );
	}
	
	
	// Get info about name change.
	$_name_change = TEAM_Manage_Name_get_change_info() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>