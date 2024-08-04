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
			
			return RESULT_generic_fail();
		}
		
		// -- Error --
		return false;
	}
	
	// -- Functions --
	
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
		$create = SQL_prep_procedure( 'CALL sp_teams_create(?, ?)', array( $team_name_handled, $_player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $create );
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
			FROM  game_users       u
			JOIN  football_players f ON f.id        = u.id
			JOIN  player_team      t ON t.player_id = f.id
			WHERE t.team_id = ?
			ORDER BY
				t.staff_role ASC,
				f.rating     DESC,
				f.id         ASC',
			array( $_team_id ) );
	}
	
	function TEAM_get_name()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_value( 'SELECT team_name FROM teams WHERE id = ?', array( $_team_id ) );
	}
	
	function TEAM_get_rankings()
	{
		// -- DB operation --
		return SQL_prep_get_multi( 'SELECT * FROM teams ORDER BY rating DESC, id ASC LIMIT 50');
	}