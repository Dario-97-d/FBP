<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_user_functions;
	
	// Required at frontend.
	$_username    = '';
	$_player_name = '';
	$_email       = '';
	
	// -- Register --
	if ( isset( $_POST['register'] ) )
	{
		if (
			isset( $_POST['username'] )
			&&
			isset( $_POST['player-name'] )
			&&
			isset( $_POST['email'] )
			&&
			isset( $_POST['password'] ) )
		{
			// -- Register player --
			$register = USER_register_player( $_POST['username'], $_POST['player-name'], $_POST['email'], $_POST['password'] ) or DIE_error();
			
			// -- Success --
			if ( RESULT_is_success( $register ) )
			{
				// -- Login Automatically --
				
				$user_id = USER_get_id_by_login( $_POST['username'], $_POST['password'] )
					?? DIE_error();
				
				// -- Success -> Redirect --
				if ( $user_id )
				{
					AUTH_login( $user_id );
					
					REDIRECT('player-overview');
				}
				
				// Display failure message.
				DIALOG_add_login_fail('could not login - something went wrong');
			}
			else
			{
				// Display failure message.
				DIALOG_add_result( $register );
			}
		}
		else
		{
			DIALOG_add_input_fail('username or player name or email or password is missing');
		}
		
		// Display given values if Register failed.
		$_username    = $_POST['username']    ?? '';
		$_player_name = $_POST['player-name'] ?? '';
		$_email       = $_POST['email']       ?? '';
	}

?>

<?php require_once $_FILEREF_frontend_layout; ?>