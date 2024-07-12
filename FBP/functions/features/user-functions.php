<?php

	// -- User Functions --
	
	// Require other functions.
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_result_functions;
	require_once $_FILEREF_sql_functions;
	
	// -- User Result handling --
	
	function USER_RESULT( $result )
	{
		// -- Success --
		if ( RESULT_is_success( $result ) ) return $result;
		
		// -- Fail --
		if ( RESULT_is_fail( $result ) )
		{
			switch ( RESULT_get_message( $result ) )
			{
				// Expected failure messages.
				case 'this email is already registered':
				case 'this username is taken':
				
					return $result;
			}
		}
		
		// -- Error --
		return false;
	}
	
	// -- Functions --
	
	function USER_exists( $id )
	{
		// -- DB operation --
		return SQL_prep_bool_or_null( 'SELECT 1 FROM game_users WHERE id = ?', array( $id ) );
	}
	
	function USER_get_id_by_login( $username, $password )
	{
		// -- Handle Input --
		
		$check_username = INPUT_handle_username( $username );
		
		// Exit if input isn't valid.
		if ( $check_username['failed'] ) return false;
		
		$username_handled = $check_username['handled'];
		
		// -- DB operation --
		$user_data = SQL_prep_get_row( 'SELECT id, pass_word FROM game_users WHERE username = ?', array( $username_handled ) );
		
		if ( $user_data )
		{
			if ( password_verify( $password, $user_data['pass_word'] ) )
			{
				return $user_data['id'];
			}
		}
		
		return false;
	}
	
	function USER_register_player( $username, $player_name, $email, $password )
	{
		// -- Handle Input --
		
		$check_username    = INPUT_handle_username   ( $username );
		$check_player_name = INPUT_handle_player_name( $player_name );
		$check_email       = INPUT_handle_email      ( $email );
		$check_password    = INPUT_handle_password   ( $password );
		
		// Exit if input isn't valid.
		if ( $check_username   ['failed'] ) return RESULT_fail( $check_username   ['message'] );
		if ( $check_player_name['failed'] ) return RESULT_fail( $check_player_name['message'] ); 
		if ( $check_email      ['failed'] ) return RESULT_fail( $check_email      ['message'] );
		if ( $check_password   ['failed'] ) return RESULT_fail( $check_password   ['message'] );
		
		$username_handled    = $check_username   ['handled'];
		$player_name_handled = $check_player_name['handled'];
		$email_handled       = $check_email      ['handled'];
		$password_handled    = $check_password   ['handled'];
		
		// -- DB operation --
		$register = SQL_prep_stmt_result( 'CALL sp_register_player(?, ?, ?, ?)', array( $username_handled, $player_name_handled, $email_handled, $password_handled ) );
		
		// -- Handle result --
		return USER_RESULT( $register );
	}