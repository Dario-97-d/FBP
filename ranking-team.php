<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_team_functions;
	
	$_teams = TEAM_get_rankings() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>