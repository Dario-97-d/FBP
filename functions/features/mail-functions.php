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
				case 'user not found':
					return $result;
			}
			
			return RESULT_generic_fail();
		}
		
		// -- Error --
		return false;
	}
	
	// -- Functions --
	
	function MAIL_get_received()
	{
		global $_user_id;
		
		return SQL_prep_get_multi(
			'SELECT
				m.*,
				u.username as sender_username
			FROM     mail m
			JOIN     game_users u ON m.receiver_id = u.id
			WHERE    sender_id = ?
			ORDER BY time_stamp DESC',
			array( $_user_id ) );
	}
	
	function MAIL_get_sent()
	{
		global $_user_id;
		
		return SQL_prep_get_multi(
			'SELECT
				m.*,
				u.username as receiver_username
			FROM     mail m
			JOIN     game_users u ON m.sender_id = u.id
			WHERE    receiver_id = ?
			ORDER BY time_stamp DESC',
			array( $_user_id ) );
	}
	
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
		$send = SQL_prep_procedure( 'CALL sp_send_mail(?,?,?)', array( $_user_id, $username_handled, $text_handled ) );
		
		// -- Handle result --
		return MAIL_RESULT( $send );
	}