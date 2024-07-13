<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_functions;
	
	// Redirect if player has team.
	if ( TEAM_get_id() ?? false ) REDIRECT('team-overview');
	
	
	// -- Create Team --
	if ( isset( $_POST[ 'new-team-name' ] ) )
	{
		$create_team = TEAM_create( $_POST[ 'new-team-name' ] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $create_team ) ) REDIRECT('team-overview');
		
		// Display failure message.
		DIALOG_add_result( $create_team );
	}

?>

<?php require_once $_FILEREF_frontend_layout; ?>