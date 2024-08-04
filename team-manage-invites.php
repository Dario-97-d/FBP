<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_manage_invites_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Check whether player is allowed to manage the team.
	if ( ! ( TEAM_Manage_is_player_allowed() ?? false) ) REDIRECT('team-overview');
	
	
	// -- Send Invite --
	if ( isset( $_POST['invite-player-id'] ) )
	{
		$invite_player = TEAM_Manage_Invites_send( $_POST['invite-player-id'] ) or DIE_error();
		
		// Display failure message.
		if ( ! RESULT_is_success( $invite_player ) ) DIALOG_add_result( $invite_player );
	}
	
	// -- Withdraw Invite --
	if ( isset( $_POST['withdraw-player-id'] ) )
	{
		$withdraw_invite = TEAM_Manage_Invites_withdraw( $_POST['withdraw-player-id'] ) or DIE_error();
		
		// Display failure message.
		if ( ! RESULT_is_success( $withdraw_invite ) ) DIALOG_add_result( $withdraw_invite );
	}
	
	
	// Get Team name.
	$_team_name = TEAM_get_name() or DIE_error();
	
	// Get invited players.
	$_invitees = TEAM_Manage_Invites_get_invitees() or DIALOG_add_team_management_fail('could not get invited players');

?>

<?php require_once $_FILEREF_frontend_layout; ?>