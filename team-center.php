<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_team_functions;
	
	// -- Accept Invite --
	if ( isset( $_POST['accept-team-id'] ) )
	{
		$accept_invite = PLAYER_Team_accept_invite( $_POST['accept-team-id'] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $accept_invite ) ) REDIRECT('team-overview');
		
		// Display failure messaage.
		DIALOG_add_result( $accept_invite );
	}
	
	// -- Apply to Team --
	if ( isset( $_POST['apply-team-id'] ) )
	{
		$apply_to_team = PLAYER_Team_apply( $_POST['apply-team-id'] ) or DIE_error();
		
		// -- Success -> Redirect (avoid form resubmission) --
		if ( RESULT_is_success( $apply_to_team ) ) REDIRECT_current();
		
		// Display failure messaage.
		DIALOG_add_result( $apply_to_team );
	}
	
	// -- Cancel Application --
	if ( isset( $_POST['cancel-team-id'] ) )
	{
		$cancel_application = PLAYER_Team_cancel_application( $_POST['cancel-team-id'] ) or DIE_error();
		
		// -- Success -> Redirect (avoid form resubmission) --
		if ( RESULT_is_success( $cancel_application ) ) REDIRECT_current();
		
		// Display failure messaage.
		DIALOG_add_result( $cancel_application );
	}
	
	// -- Leave Team --
	if ( isset( $_POST['leave-team'] ) )
	{
		$leave_team = PLAYER_Team_leave() or DIE_error();
		
		// -- Success -> Redirect (avoid form resubmission) --
		if ( RESULT_is_success( $leave_team ) ) REDIRECT_current();
		
		// Display failure messaage.
		DIALOG_add_result( $leave_team );
	}
	
	// -- Reject Invite --
	if ( isset( $_POST['reject-team-id'] ) )
	{
		$reject_invite = PLAYER_Team_reject_invite( $_POST['reject-team-id'] ) or DIE_error();
		
		// -- Success -> Redirect (avoid form resubmission) --
		if ( RESULT_is_success( $reject_invite ) ) REDIRECT_current();
		
		// Display failure messaage.
		DIALOG_add_result( $reject_invite );
	}
	
	
	// Check whether player has team.
	$_player_has_team = PLAYER_has_team();
	
	// Get invites from teams.
	$_team_invites = PLAYER_Team_get_invites() or DIALOG_add_team_fail('could not get invites');
	
	// Get applications to teams.
	$_team_applications = PLAYER_Team_get_applications() or DIALOG_add_team_fail('could not get applications');

?>

<?php require_once $_FILEREF_frontend_layout; ?>