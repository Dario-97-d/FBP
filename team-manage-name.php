<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Check whether player is captain.
	if ( ! ( TEAM_is_player_captain() ?? false ) ) REDIRECT('team-overview');
	
	
	// -- Change Team Name --
	if ( isset( $_POST['new-team-name'] ) )
	{
		$update_team_name = TEAM_update_name( $_POST['new-team-name'] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $update_team_name ) ) REDIRECT('team-overview');
		
		// Display failure message.
		DIALOG_add_result( $update_team_name );
	}
	
	
	// Get info about name change.
	$_name_change = TEAM_get_name_change_info() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>