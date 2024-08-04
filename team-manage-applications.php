<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_manage_applications_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Check whether player is allowed to manage the team.
	if ( ! ( TEAM_Manage_is_player_allowed() ?? false) ) REDIRECT('team-overview');
	
	
	// -- Accept Application --
	if ( isset( $_POST['accept-player-id'] ) )
	{
		$accept_application = TEAM_Manage_Applications_accept_player( $_POST['accept-player-id'] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $accept_application ) ) REDIRECT('team-overview');
		
		// Display failure message.
		DIALOG_add_result( $accept_application );
	}
	
	// -- Reject Application --
	if ( isset( $_POST['reject-player-id'] ) )
	{
		$reject_application = TEAM_Manage_Applications_reject_player( $_POST['reject-player-id'] ) or DIE_error();
		
		// -- Success -> Redirect (avoid form resubmission) --
		if ( RESULT_is_success( $reject_application ) ) REDIRECT_current();
		
		// Display failure message.
		DIALOG_add_result( $reject_application );
	}
	
	
	// Get Team name.
	$_team_name = TEAM_get_name() or DIE_error();
	
	// Get applications from players.
	$_team_applicants = TEAM_Manage_Applications_get_applicants() or DIALOG_add_team_management_fail('could not get applicants');

?>

<?php require_once $_FILEREF_frontend_layout; ?>