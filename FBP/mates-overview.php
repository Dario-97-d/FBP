<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_mates_functions;
	
	// -- Submit Request --
	if ( isset( $_POST['request-mate-username'] ) )
	{
		$request_mate = MATES_send_request( $_POST['request-mate-username'] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $request_mate ) ) REDIRECT('mates-sent');
		
		// Display failure message.
		DIALOG_add_result( $request_mate );
	}
	
	// -- Remove Mate --
	if ( isset($_POST['remove-mate-id']) )
	{
		$remove_mate = MATES_remove( $_POST['remove-mate-id'] ) or DIE_error();
		
		// Display failure message.
		if ( ! RESULT_is_success( $remove_mate ) ) DIALOG_add_result( $remove_mate );
	}
	
	
	// Get Mates.
	$_mates = MATES_get_current_mates() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>