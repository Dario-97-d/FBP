<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_search_functions;
	
	if ( isset( $_GET['by-name'] ) )
	{
		$_players_found = SEARCH_player_by_name( $_GET['by-name'] ) or DIALOG_add_search_fail('could not search player');
	}
	
	// Required at frontend.
	$_search_name = $_GET['by-name'] ?? '';
	$_players_found ??= true;

?>

<?php require_once $_FILEREF_frontend_layout; ?>