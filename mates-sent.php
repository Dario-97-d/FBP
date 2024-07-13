<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_mates_functions;
	
	// -- Cancel Request --
	if ( isset( $_POST['cancel-mate-id'] ) )
	{
		$cancel_request = MATES_cancel_request( $_POST['cancel-mate-id'] ) or DIE_error();
		
		// Display failure message.
		if ( ! RESULT_is_success( $cancel_request ) ) DIALOG_add_result( $cancel_request );
	}
	
	
	//  Get requests sent.
	$_requests_sent = MATES_get_requests_sent() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>