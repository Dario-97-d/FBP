<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Check whether player is captain.
	if ( ! ( TEAM_is_player_captain() ?? false ) ) REDIRECT('team-overview');
	
	
	// -- Eliminate Team --
	if ( isset( $_POST['eliminate-team'] ) )
	{
		$eliminate_team = TEAM_eliminate() or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $eliminate_team ) ) REDIRECt('team-center');
		
		// Display failure message.
		DIALOG_add_result( $eliminate_team );
	}
	
	
	// Get Team name.
	$_team_name = TEAM_get_name() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>