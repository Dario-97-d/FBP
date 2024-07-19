<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_mail_functions;
	
	// Required at frontend.
	$_to_username = '';
	$_mail_text = '';
	
	// -- Display Username --
	if ( isset( $_GET['to-username'] ) )
	{
		$_to_username = $_GET['to-username'];
		
		// Check whether username is valid.
		MAIL_is_username_valid( $_to_username ) or DIALOG_add_input_fail( 'invalid username: '.$_GET['to-username'] );
	}
	
	// -- Send Message --
	if ( isset( $_POST['send'] ) )
	{
		// Check whether input was given.
		if ( isset( $_POST['to-username'] ) && isset( $_POST['message'] ) )
		{
			$send_mail = MAIL_send( $_POST['to-username'], $_POST['message'] ) or DIE_error();
			
			// -- Success -> Redirect --
			if ( RESULT_is_success( $send_mail ) ) REDIRECT('mail-sent');
			
			// Display failure message.
			DIALOG_add_result( $send_mail );
		}
		else
		{
			DIALOG_add_input_fail('missing username or text');
		}
		
		// Keep user input in frontend, if given, on failure (if mail is successful then user is redirected).
		$_to_username = $_POST['to-username'] ?? '';
		$_mail_text = $_POST['message'] ?? '';
	}

?>

<?php require_once $_FILEREF_frontend_layout; ?>