<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_functions;
	
	$_player = PLAYER_get_overview() or DIE_error();
	
	$_generic_atts = PLAYER_get_generic_attributes_from_player( $_player );

?>

<?php require_once $_FILEREF_frontend_layout; ?>