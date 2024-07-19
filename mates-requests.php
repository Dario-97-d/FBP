<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_mates_functions;
	
	// -- Accept Request --
	if ( isset( $_POST['accept-mate-id'] ) )
	{
		$accept_request = MATES_accept_request( $_POST['accept-mate-id'] ) or DIE_error();
		
		// -- Success -> Redirect --
		if ( RESULT_is_success( $accept_request ) ) REDIRECT('mates-overview');
		
		// Display failure message.
		DIALOG_add_result( $accept_request );
	}
	
	// -- Decline Request --
	if ( isset( $_POST['decline-mate-id'] ) )
	{
		$decline_request = MATES_decline_request( $_POST['decline-mate-id'] ) or DIE_error();
		
		// Display failure message.
		if ( ! RESULT_is_success( $decline_request ) ) DIALOG_add_result( $decline_request );
	}
	
	
	// Get requests received.
	$_requests_received = MATES_get_requests_received() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>