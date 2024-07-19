<?php

	// -- Player functions --
	
	// Require other functions.
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_result_functions;
	require_once $_FILEREF_sql_functions;
	
	// -- Player Result handling --
	
	function PLAYER_RESULT( $result )
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
				case 'this player already has a team':
				case 'this player already has an application to this team':
				case 'this player already has 5 applications':
				case 'this player doesn\'t have a team':
				case 'this player is not free to leave the team':
				
					return $result;
			}
			
			return RESULT_generic_fail();
		}
		
		// -- Error --
		return false;
	}
	
	// -- Functions --
	
	function PLAYER_accept_team_invite( $team_id )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return RESULT_fail('invalid team id');
		
		// -- DB operation --
		$accept = SQL_prep_procedure( 'CALL sp_teams_accept_invite(?, ?)', array( $_player_id, $team_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $accept );
	}
	
	function PLAYER_apply_to_team( $team_id )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return RESULT_fail('invalid team id');
		
		// -- DB operation --
		$apply = SQL_prep_procedure( 'CALL sp_teams_apply(?, ?)', array( $_player_id, $team_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $apply );
	}
	
	function PLAYER_can_invite_to_team()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_bool_or_null( 'SELECT 1 FROM player_team WHERE player_id = ? AND staff_role = \'Captain\'', array( $_player_id ) );
	}
	
	function PLAYER_cancel_team_application( $team_id )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return RESULT_fail('invalid team id');
		
		// -- DB operation --
		$cancel = SQL_prep_stmt_one( 'DELETE FROM player_team_applications WHERE player_id = ? AND team_id = ?', array( $_player_id, $team_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $cancel );
	}
	
	function PLAYER_get_generic_play_profile( $player_id )
	{
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return false;
		
		// -- DB operation --
		return SQL_prep_get_row(
			'SELECT
				f.player_name,
				f.rating,
				g.strength,
				g.movement,
				g.skill,
				g.attacking,
				g.defending
			FROM  football_players   f
			JOIN  generic_attributes g ON g.player_id = f.id
			WHERE f.id = ?',
			array( $player_id ) );
	}
	
	function PLAYER_get_mate_status( $checked_id )
	{
		global $_user_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $checked_id ) ) return false;
		
		// -- DB operation --
		return SQL_prep_get_value(
			'SELECT
				CASE
					WHEN find_in_set(?, mates)       > 0 THEN \'mates\'
					WHEN find_in_set(?, requests_to) > 0 THEN \'request sent\'
					WHEN find_in_set(?, requests_of) > 0 THEN \'request received\'
					ELSE \'none\'
				END
			FROM  user_mates
			WHERE id = ?',
			array( $checked_id, $checked_id, $checked_id, $_user_id ) );
	}
	
	function PLAYER_get_overview()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_get_row(
			'SELECT
				u.username,
				f.player_name,
				f.rating,
				g.*,
				p.*
			FROM  game_users         u
			JOIN  football_players   f ON f.id        = u.id
			JOIN  generic_attributes g ON g.player_id = f.id
			JOIN  playing_attributes p ON p.player_id = f.id
			WHERE f.id = ?',
			array( $_player_id ) );
	}
	
	function PLAYER_get_play_3_data( $player_id )
	{
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return false;
		
		// -- DB operation --
		return SQL_prep_get_row(
			'SELECT
				f.id,
				f.player_name,
				f.rating,
				g.skill
			FROM  football_players   f
			JOIN  generic_attributes g ON g.player_id = f.id
			WHERE f.id = ?',
			array( $player_id ) );
	}
	
	function PLAYER_get_profile( $player_id )
	{
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return false;
		
		// -- DB operation --
		return SQL_prep_get_row(
			'SELECT
				u.username,
				f.player_name,
				f.rating,
				g.strength,
				g.movement,
				g.skill,
				g.attacking,
				g.defending,
				t.team_name
			FROM game_users         u
			JOIN football_players   f ON f.id        = u.id
			JOIN generic_attributes g ON g.player_id = f.id
			JOIN player_team        p ON p.player_id = f.id
			LEFT JOIN teams         t ON t.id        = p.team_id
			WHERE f.id = ?',
			array( $player_id ) );
	}
	
	function TEAM_get_ranking_players()
	{
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id           as player_id,
				f.player_name,
				f.rating,
				t.id           as team_id,
				t.team_name
			FROM game_users       u
			JOIN football_players f ON f.id        = u.id
			JOIN player_team      p ON p.player_id = f.id
			LEFT JOIN teams       t ON t.id        = p.team_id
			ORDER BY
				rating DESC,
				f.id ASC' );
	}
	
	function PLAYER_get_team_applications()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				t.id,
				t.team_name
			FROM  player_team_applications a
			JOIN  teams                    t ON a.team_id = t.id
			WHERE a.player_id = ?',
			array( $_player_id ) );
	}
	
	function PLAYER_get_team_invites()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				t.id,
				t.team_name
			FROM  team_player_invites i
			JOIN  teams               t ON i.team_id = t.id
			WHERE i.player_id = ?',
			array( $_player_id ) );
	}
	
	function PLAYER_get_training_data()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_get_row(
			'SELECT
				f.player_name as name,
				f.rating,
				g.*,
				p.*
			FROM  football_players   f
			JOIN  generic_attributes g ON g.player_id = f.id
			JOIN  playing_attributes p ON p.player_id = f.id
			WHERE f.id = ?',
			array( $_player_id ) );
	}
	
	function PLAYER_has_team()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_bool_or_null( 'SELECT 1 FROM player_team WHERE player_id = ? AND team_id IS NOT NULL', array( $_player_id ) );
	}
	
	function PLAYER_is_invite_allowed()
	{
		global $_player_id;
		global $_profile_id;
		
		return SQL_prep_bool_or_null(
			'SELECT 1 WHERE
				( SELECT 1 FROM player_team WHERE player_id = ? AND staff_role = \'Captain\' )
				AND
				( SELECT 1 FROM player_team WHERE player_id = ? AND team_id IS NULL )',
			array( $_player_id, $_profile_id ) );
	}
	
	function PLAYER_leave_team()
	{
		global $_player_id;
		
		// -- DB operation --
		$leave = SQL_prep_stmt_result( "CALL sp_teams_player_leave(?)", array( $_player_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $leave );
	}
	
	function PLAYER_reject_team_invite( $team_id )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return RESULT_fail('invalid team id');
		
		// -- DB operation --
		$reject = SQL_prep_stmt_one( 'DELETE FROM team_player_invites WHERE team_id = ? AND player_id = ?', array( $team_id, $_player_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $reject );
	}