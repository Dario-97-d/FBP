<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_player_development_functions;
	
	// -- Upgrade Generic Attribute --
	if ( isset( $_POST['upgrade-generic-attribute'] ) )
	{
		// Get name of submit element clicked.
		PLAYER_Development_upgrade_generic_attribute( array_search( '+', $_POST ) ) or DIE_error();
		
		// Avoid form resubmission.
		REDIRECT_current();
	}
	
	// -- Upgrade Playing Attribute --
	if ( isset( $_POST['upgrade-playing-attribute'] ) )
	{
		// Get name of submit element clicked.
		PLAYER_Development_upgrade_playing_attribute( array_search( '+', $_POST ) ) or DIE_error();
		
		// Avoid form resubmission.
		REDIRECT_current();
	}
	
	
	$_player = PLAYER_Development_get_attributes() or DIE_error();
	
	$_generic_upgrade_disabled = $_player['available_points'] > 0 ? '' : 'disabled';
	
	$_upgradeable_atts = PLAYER_Development_get_upgradeable_atts( $_player );

?>

<?php require_once $_FILEREF_frontend_layout; ?>