<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	
	// -- Accept Invite --
	if ( isset( $_POST['accept-team-id'] ) )
	{
		$accept_invite = PLAYER_accept_team_invite( $_POST['accept-team-id'] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $accept_invite ) ) REDIRECT('team-overview');
		
		// Display failure messaage.
		DIALOG_add_result( $accept_invite );
	}
	
	// -- Apply to Team --
	if ( isset( $_POST['apply-team-id'] ) )
	{
		$apply_to_team = PLAYER_apply_to_team( $_POST['apply-team-id'] ) or DIE_error();
		
		// Display failure messaage.
		if ( ! RESULT_is_success( $apply_to_team ) ) DIALOG_add_result( $apply_to_team );
	}
	
	// -- Cancel Application --
	if ( isset( $_POST['cancel-team-id'] ) )
	{
		$cancel_application = PLAYER_cancel_team_application( $_POST['cancel-team-id'] ) or DIE_error();
		
		// Display failure messaage.
		if ( ! RESULT_is_success( $cancel_application ) ) DIALOG_add_result( $cancel_application );
	}
	
	// -- Leave Team --
	if ( isset( $_POST['leave-team'] ) )
	{
		$leave_team = PLAYER_leave_team() or DIE_error();
		
		// Display failure messaage.
		if ( ! RESULT_is_success( $leave_team ) ) DIALOG_add_result( $leave_team );
	}
	
	// -- Reject Invite --
	if ( isset( $_POST['reject-team-id'] ) )
	{
		$reject_invite = PLAYER_reject_team_invite( $_POST['reject-team-id'] ) or DIE_error();
		
		// Display failure messaage.
		if ( ! RESULT_is_success( $reject_invite ) ) DIALOG_add_result( $reject_invite );
	}
	
	
	// Check whether player has team.
	$_player_has_team = PLAYER_has_team();
	
	// Get invites from teams.
	$_team_invites = PLAYER_get_team_invites() or DIALOG_add_team_fail('could not get invites');
	
	// Get applications to teams.
	$_team_applications = PLAYER_get_team_applications() or DIALOG_add_team_fail('could not get applications');

?>

<?php require_once $_FILEREF_frontend_layout; ?>