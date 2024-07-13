<?php

	// -- Mail Functions --
	
	// Require other functions.
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_result_functions;
	require_once $_FILEREF_sql_functions;
	
	// -- Mail Result handling --
	
	function MAIL_RESULT( $result )
	{
		// -- Success --
		if ( RESULT_is_success( $result ) ) return $result;
		
		// -- Fail --
		if ( RESULT_is_fail( $result ) )
		{
			switch ( $result )
			{
				// Expected failure messages.
				case 'Column \'mail_to\' cannot be null':
					return RESULT_fail('user not found');
			}
			
			return RESULT_generic_fail();
		}
		
		// -- Error --
		return false;
	}
	
	// -- Functions --
	
	function MAIL_is_username_valid( $username )
	{
		return ! INPUT_handle_username( $username )['failed'];
	}
	
	function MAIL_send( $receiver_username, $message )
	{
		global $_user_id;
		
		// -- Handle Input --
		
		$check_username = INPUT_handle_username( $receiver_username );
		$check_text     = INPUT_handle_text    ( $message );
		
		// Exit if input isn't valid.
		if ( $check_username['failed'] ) return RESULT_fail('invalid username');
		if ( $check_text    ['failed'] ) return RESULT_fail( 'invalid text: '.$check_text['message'] );
		
		$username_handled = $check_username['handled'];
		$text_handled     = $check_text    ['handled'];
		
		// -- DB operation --
		$send = SQL_prep_stmt_one(
			'INSERT INTO mail (mail_of, mail_to, mail_text)
			VALUES (
				?,
				(SELECT id FROM game_users WHERE username = ?),
				?)',
			array( $_user_id, $username_handled, $text_handled ) );
		
		// -- Handle result --
		return MAIL_RESULT( $send );
	}