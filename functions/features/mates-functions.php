<?php

	// -- Mates Functions --
	
	// Require other functions.
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_result_functions;
	require_once $_FILEREF_sql_functions;
	
	// -- Mates Result handling --
	
	function MATES_RESULT( $result )
	{
		// -- Success --
		if ( RESULT_is_success( $result ) ) return $result;
		
		// -- Fail --
		if ( RESULT_is_fail( $result ) )
		{
			switch ( RESULT_get_message( $result ) )
			{
				// Expected failure messages.
				case 'request not found':
				case 'there is already a pending request':
				case 'these users are already mates':
				case 'user not found':
				
					return $result;
			}
			
			return RESULT_generic_fail();
		}
		
		// -- Error --
		return false;
	}
	
	// -- Functions --
	
	function MATES_accept_request( $accepted_id )
	{
		global $_user_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $accepted_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$accept = SQL_prep_procedure( 'CALL sp_mates_accept_request(?, ?)', array( $_user_id, $accepted_id ) );
		
		// -- Handle result --
		return MATES_RESULT( $accept );
	}
	
	function MATES_cancel_request( $cancelled_id )
	{
		global $_user_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $cancelled_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$cancel = SQL_prep_stmt_one( 'DELETE FROM mate_requests WHERE requester_id = ? AND requested_id = ?;', array( $_user_id, $cancelled_id ) );
		
		// -- Handle result --
		return MATES_RESULT( $cancel );
	}
	
	function MATES_decline_request( $declined_id )
	{
		global $_user_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $declined_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$decline = SQL_prep_stmt_one( 'DELETE FROM mate_requests WHERE requester_id = ? AND requested_id = ?', array( $declined_id, $_user_id ) );
		
		// -- Handle result --
		return MATES_RESULT( $decline );
	}
	
	function MATES_get_current_mates()
	{
		global $_user_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id           as player_id,
				f.player_name,
				t.id           as team_id,
				t.team_name
			FROM mates      m
			JOIN game_users u
			ON
				u.id = m.user1_id AND m.user2_id = ?
			OR
				u.id = m.user2_id AND m.user1_id = ?
			JOIN football_players f ON f.id        = u.id
			JOIN player_team      p ON p.player_id = f.id
			LEFT JOIN teams       t ON t.id        = p.team_id',
			array( $_user_id, $_user_id ) );
	}
	
	function MATES_get_requests_received()
	{
		global $_user_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id           as player_id,
				f.player_name,
				t.id           as team_id,
				t.team_name
			FROM mate_requests    r
			JOIN game_users       u ON u.id        = r.requester_id
			JOIN football_players f ON f.id        = u.id
			JOIN player_team      p ON p.player_id = f.id
			LEFT JOIN teams       t ON t.id        = p.team_id
			WHERE r.requested_id = ?',
			array( $_user_id ) );
	}
	
	function MATES_get_requests_sent()
	{
		global $_user_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id           as player_id,
				f.player_name,
				t.id           as team_id,
				t.team_name
			FROM mate_requests    r
			JOIN game_users       u ON u.id        = r.requested_id
			JOIN football_players f ON f.id        = u.id
			JOIN player_team      p ON p.player_id = f.id
			LEFT JOIN teams       t ON t.id        = p.team_id
			WHERE r.requester_id = ?',
			array( $_user_id ) );
	}
	
	function MATES_remove( $removed_id )
	{
		global $_user_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $removed_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$remove = SQL_prep_stmt_one(
			'DELETE FROM mates
			WHERE
				( user1_id = ? AND user2_id = ? )
			OR
				( user1_id = ? AND user2_id = ? )',
			array( $_user_id, $removed_id, $removed_id, $_user_id ) );
		
		// -- Handle result --
		return MATES_RESULT( $remove );
	}
	
	function MATES_send_request( $to_username )
	{
		global $_user_id;
		
		// -- Handle Input --
		
		$check_username = INPUT_handle_username( $to_username );
		
		// Exit if input isn't valid.
		if ( $check_username['failed'] ) return RESULT_fail( 'invalid username: '.$to_username );
		
		$username_handled = $check_username['handled'];
		
		// -- DB operation --
		$request = SQL_prep_procedure( 'CALL sp_mates_send_request(?, ?)', array( $_user_id, $username_handled ) );
		
		// -- Handle result --
		return MATES_RESULT( $request );
	}