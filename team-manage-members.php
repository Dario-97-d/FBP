<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_manage_members_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Check whether player is allowed to manage the team.
	if ( ! ( TEAM_Manage_is_player_allowed() ?? false ) ) REDIRECT('team-overview');
	
	
	// -- Set member as --
	if ( isset( $_POST['set-player-as'] ) )
	{
		if ( isset( $_POST['player-id'] ) && isset( $_POST['staff-role'] ) )
		{
			$update_staff_role = TEAM_Manage_Members_update_staff_role( $target_player_id, $target_staff_role ) or DIE_error();
			
			// -- Success -> Redirect (avoid form resubmission) --
			if ( RESULT_is_success( $update_staff_role ) ) REDIRECT_current();
			
			// Display failure message.
			DIALOG_add_result( $update_staff_role );
		}
		else
		{
			DIALOG_add_input_fail('player or staff role missing');
		}
	}
	
	// -- Expel player --
	if ( isset( $_POST['expel-player-at-username'] ) )
	{
		// Remove @ at the beginning of the name.
		$expel_player = TEAM_Manage_Members_expel( substr( $_POST['expel-player-at-username'], 1 ) ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $expel_player ) ) REDIRECT('team-overview');
		
		// Display failure message.
		DIALOG_add_result( $expel_player );
	}
	
	
	// Get Team name.
	$_team_name = TEAM_get_name() or DIE_error();
	
	// Get Team members.
	$_team_members = TEAM_get_members() or DIE_error();
	
	// Get an array for the html element <select>.
	$_select_members = TEAM_Manage_Members_get_select_assoc( $_team_members );

?>

<?php require_once $_FILEREF_frontend_layout; ?>