<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_manage_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Check whether player is allowed to manage the team.
	if ( ! ( TEAM_Manage_is_player_allowed() ?? false ) ) REDIRECT('team-overview');
	
	
	// -- Eliminate Team --
	if ( isset( $_POST['eliminate-team'] ) )
	{
		$eliminate_team = TEAM_Manage_eliminate() or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $eliminate_team ) ) REDIRECT('team-center');
		
		// Display failure message.
		DIALOG_add_result( $eliminate_team );
	}
	
	
	// Get Team name.
	$_team_name = TEAM_get_name() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>