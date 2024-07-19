<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Redirect if player *is not* captain.
	if ( ! ( TEAM_is_player_captain() ?? false) ) REDIRECT('team-overview');
	
	
	// -- Accept Application --
	if ( isset( $_POST['accept-player-id'] ) )
	{
		$accept_application = TEAM_accept_player_application( $_POST['accept-player-id'] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $accept_application ) ) REDIRECT('team-overview');
		
		// Display failure message.
		DIALOG_add_result( $accept_application );
	}
	
	// -- Reject Application --
	if ( isset( $_POST['reject-player-id'] ) )
	{
		$reject_application = TEAM_reject_player_application( $_POST['reject-player-id'] ) or DIE_error();
		
		// Display failure message.
		if ( ! RESULT_is_success( $reject_application ) ) DIALOG_add_result( $reject_application );
	}
	
	
	// Get Team name.
	$_team_name = TEAM_get_name() or DIE_error();
	
	// Get applications from players.
	$_team_applicants = TEAM_get_applicants() or DIALOG_add_team_management_fail('could not get applicants');

?>

<?php require_once $_FILEREF_frontend_layout; ?>