<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_user_functions;
	
	// Required at frontend.
	$_username = '';
	
	// -- Login --
	if ( isset( $_POST['login'] ) )
	{
		if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) )
		{
			$user_id = USER_get_id_by_login( $_POST['username'], $_POST['password'] )
				?? DIE_error();
			
			// -- Success -> Redirect --
			if ( $user_id )
			{
				AUTH_login( $user_id );
				
				REDIRECT('player-overview');
			}
			
			// Display failure message.
			DIALOG_add_login_fail('wrong credentials');
		}
		else
		{
			DIALOG_add_input_fail('username or password missing');
		}
		
		// Display given values if Login failed.
		$_username = $_POST['username'] ?? '';
	}

?>

<?php require_once $_FILEREF_frontend_layout; ?>