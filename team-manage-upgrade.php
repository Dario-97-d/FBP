<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_manage_functions;
	
	// Get Team id.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Check whether player is allowed to manage the team.
	if ( ! ( TEAM_Manage_is_player_allowed() ?? false ) ) REDIRECT('team-overview');
	
	// Get Team info.
	$_team = TEAM_get_info() or DIE_error();;

?>

<?php require_once $_FILEREF_frontend_layout; ?>