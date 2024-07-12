<?php

	// -- Team functions --
	
	// Require other functions.
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_result_functions;
	require_once $_FILEREF_sql_functions;
	
	// -- Team Result handling --
	
	function TEAM_RESULT( $result )
	{
		// -- Success --
		if ( RESULT_is_success( $result ) ) return $result;
		
		// -- Fail --
		if ( RESULT_is_fail( $result ) )
		{
			switch ( RESULT_get_message( $result ) )
			{
				// Expected failure messages.
				case 'invite not found':
				case 'player not found':
				case 'team not found':
				case 'this player already has a team':
				case 'this player is a captain of this team':
				case 'this player is not in this team':
				case 'this team has permanent members':
				case 'this team name is taken':
				
					return $result;
			}
		}
		
		// -- Error --
		return false;
	}
	
	// -- Functions --
	
	function TEAM_accept_player_application( $player_id )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return RESULT_fail('invalid player id');
		
		// -- DB operation --
		$accept = SQL_prep_stmt_result( 'CALL sp_teams_accept_application(?, ?)', array( $_team_id, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $accept );
	}
	
	function TEAM_check_is_member_captain( $team_members, $member_id )
	{
		foreach ( $team_members as $member )
		{
			if ( $member['player_id'] == $member_id )
			{
				return $member['staff_role'] == 'Captain';
			}
		}
		
		return false;
	}
	
	function TEAM_create( $team_name )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		$check_team_name = INPUT_handle_team_name( $team_name );
		
		// Exit if input isn't valid.
		if ( $check_team_name['failed'] ) return RESULT_fail( $check_team_name['message'] );
		
		$team_name_handled = $check_team_name['handled'];
		
		// -- DB operation --
		$create = SQL_prep_stmt_result( 'CALL sp_teams_create(?, ?)', array( $team_name_handled, $_player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $create );
	}
	
	function TEAM_eliminate()
	{
		global $_team_id;
		
		// -- DB operation --
		$eliminate = SQL_prep_stmt_result( 'CALL sp_teams_eliminate(?)', array( $_team_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $eliminate );
	}
	
	function TEAM_expel_player( $username )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		$check_username = INPUT_handle_username( $username );
		
		// Exit if input isn't valid.
		if ( $check_username['failed'] ) return RESULT_fail('invalid username');
		
		$username_handled = $check_username['handled'];
		
		// -- DB operation --
		$expel = SQL_prep_stmt_result( 'CALL sp_teams_expel_player(?, ?)', array( $username_handled, $_team_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $expel );
	}
	
	function TEAM_get_applicants()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id          as player_id,
				f.player_name
			FROM game_users                     u
			JOIN football_players               f ON f.id = u.id
			RIGHT JOIN player_team_applications a ON a.player_id = f.id
			WHERE a.team_id = ?',
			array( $_team_id ) );
	}
	
	function TEAM_get_id()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_get_value( 'SELECT team_id FROM player_team WHERE player_id = ?', array( $_player_id ) );
	}
	
	function TEAM_get_info()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_row( 'SELECT * FROM teams WHERE id = ?', array( $_team_id ) );
	}
	
	function TEAM_get_invitees()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id          as player_id,
				f.player_name
			FROM game_users                u
			JOIN football_players          f ON f.id = u.id
			RIGHT JOIN team_player_invites i ON i.player_id = f.id
			WHERE i.team_id = ?',
			array( $_team_id ) );
	}
	
	function TEAM_get_members()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id           as player_id,
				f.player_name,
				f.rating       as player_rating,
				t.staff_role
			FROM game_users       u
			JOIN football_players f ON f.id = u.id
			JOIN player_team      t ON t.player_id = f.id
			WHERE t.team_id = ?
			ORDER BY staff_role ASC, f.id ASC',
			array( $_team_id ) );
	}
	
	function TEAM_get_name()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_value( 'SELECT team_name FROM teams WHERE id = ?', array( $_team_id ) );
	}
	
	function TEAM_get_name_change_info()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_row(
			'SELECT
				team_name                                           as current_name,
				last_name_change                                    as last_change,
				last_name_change < DATE_SUB(now(), INTERVAL 1 week) as is_allowed
			FROM teams WHERE id = ?',
			array( $_team_id ) );
	}
	
	function TEAM_get_player_team_status()
	{
		global $_player_id;
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_value(
			'SELECT
				CASE
					WHEN EXISTS (SELECT 1 FROM player_team WHERE player_id = ? AND team_id IS NOT NULL) THEN \'has team\'
					WHEN EXISTS (SELECT 1 FROM player_team_applications WHERE player_id = ? AND team_id = ?) THEN \'has application\'
					WHEN EXISTS (SELECT 1 FROM team_player_invites WHERE team_id = ? AND player_id = ?) THEN \'has invite\'
					WHEN (SELECT count(player_id) FROM player_team_applications WHERE player_id = ? GROUP BY player_id) >= 5 THEN \'has 5 applications\'
					ELSE \'none\'
				END',
			array(
				$_player_id,
				$_player_id, $_team_id,
				$_team_id, $_player_id,
				$_player_id
			)
		);
	}
	
	function TEAM_get_ranking_teams()
	{
		// -- DB operation --
		return SQL_prep_get_multi( 'SELECT * FROM teams ORDER BY rating DESC, id ASC LIMIT 50');
	}
	
	function TEAM_get_select_members( $members )
	{
		// Avoid having current player in select list.
		global $_player_id;
		
		$select_members = array();
		foreach ( $members as $member )
		{
			// Avoid having current player in select list.
			if ( $member['player_id'] == $_player_id ) continue;
			
			$members[ $member['player_id'] ] = $member['player_name'];
		}
		
		return $select_members;
	}
	
	function TEAM_invite_player( $player_id )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$invite = SQL_prep_stmt_one( 'INSERT INTO team_player_invites (team_id, player_id) VALUES (?, ?)', array( $_team_id, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $invite );
	}
	
	function TEAM_is_in_applications( $team_id, $applications )
	{
		if ( is_array( $applications ) )
		{
			foreach( $applications as $team )
			{
				if ( $team['id'] == $team_id )
				{
					return true;
				}
			}
		}
		else
		{
			LOGGER_log_player_error('$applications is not array at TEAM_is_in_applications().');
		}
		
		return false;
	}
	
	function TEAM_is_player_captain()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_bool_or_null( 'SELECT 1 FROM player_team WHERE player_id = ? AND staff_role = ?', array( $_player_id, 'Captain' ) );
	}
	
	function TEAM_reject_player_application( $player_id )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$reject = SQL_prep_stmt_one( 'DELETE FROM player_team_applications WHERE team_id = ? AND player_id = ?', array( $_team_id, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $reject );
	}
	
	function TEAM_update_name( $new_name )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		$check_new_name = INPUT_handle_team_name( $new_name );
		
		// Exit if input isn't valid.
		if ( $check_new_name['failed'] ) return RESULT_fail( 'invalid team name' );
		
		$new_name_handled = $check_new_name['handled'];
		
		// -- DB operation --
		$update = SQL_prep_stmt_one(
			'UPDATE teams SET team_name = ?, last_name_change = CURRENT_TIMESTAMP
			WHERE id = ? AND DATE(last_name_change) < DATE(DATE_SUB(NOW(), INTERVAL 1 WEEK))',
			array( $new_name_handled, $_team_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $update );
	}
	
	function TEAM_update_staff_role( $player_id, $staff_role )
	{
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid        ( $player_id  ) ) return RESULT_fail('invalid player id');
		if ( ! INPUT_is_valid_staff_role( $staff_role ) ) return RESULT_fail('invalid staff role');
		
		// -- DB operation --
		$update = SQL_prep_stmt_one( 'UPDATE player_team SET staff_role = ? WHERE player_id = ?', array( $staff_role, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $update );
	}
	
	function TEAM_withdraw_invite_to_player( $player_id )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$withdraw = SQL_prep_stmt_one( 'DELETE FROM team_player_invites WHERE team_id = ? AND player_id = ?', array( $_team_id, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $withdraw );
	}