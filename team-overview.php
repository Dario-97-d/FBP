<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_functions;
	
	// Get Team id or redirect if player doesn't have team.
	$_team_id = TEAM_get_id() or REDIRECT('team-center');
	
	// Get Team info.
	$_team = TEAM_get_info() or DIE_error();
	
	// Get team members.
	$_team_members = TEAM_get_members() or DIE_error();
	
	
	// Check whether link to management page should be displayed.
	$_show_link_management = TEAM_check_is_member_captain( $_team_members, $_player_id );

?>

<?php require_once $_FILEREF_frontend_layout; ?>