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
	
	function PLAYER_get_development_data()
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
	
	function PLAYER_get_generic_attributes_from_player( $player )
	{
		return array(
			'strength'  => $player['strength'],
			'movement'  => $player['movement'],
			'skill'     => $player['skill'],
			'attacking' => $player['attacking'],
			'defending' => $player['defending']);
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
					WHEN EXISTS (SELECT 1 FROM mates         WHERE user1_id = ? AND user2_id = ? OR user1_id = ? AND user2_id = ?) THEN \'mates\'
					WHEN EXISTS (SELECT 1 FROM mate_requests WHERE requester_id = ? AND requested_id = ?)                          THEN \'request sent\'
					WHEN EXISTS (SELECT 1 FROM mate_requests WHERE requester_id = ? AND requested_id = ?)                          THEN \'request received\'
					ELSE \'none\'
				END',
			array(
				$_user_id, $checked_id, $checked_id, $_user_id,
				$_user_id, $checked_id,
				$checked_id, $_user_id
			) );
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
	
	function PLAYER_get_rankings()
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
	
	function PLAYER_get_upgradeable_atts( $player )
	{
		$used_movement  = $player['speed']     + $player['agility'];
		$used_strength  = $player['airplay']   + $player['power'];
		$used_skill     = $player['dribble']   + $player['pass']    + $player['shoot'] + $player['tackle'];
		$used_attacking = $player['position']  + $player['vision'];
		$used_defending = $player['prevision'] + $player['marking'];
		
		$available_movement  = $player['movement']  - $used_movement;
		$available_strength  = $player['strength']  - $used_strength;
		$available_skill     = $player['skill']     - $used_skill;
		$available_attacking = $player['attacking'] - $used_attacking;
		$available_defending = $player['defending'] - $used_defending;
		
		$trainable = array();
		
		$trainable['speed']     = $available_movement  > 0;
		$trainable['agility']   = $available_movement  > 0;
		$trainable['airplay']   = $available_strength  > 0;
		$trainable['power']     = $available_strength  > 0;
		$trainable['dribble']   = $available_skill     > 0;
		$trainable['pass']      = $available_skill     > 0;
		$trainable['shoot']     = $available_skill     > 0;
		$trainable['tackle']    = $available_skill     > 0;
		$trainable['position']  = $available_attacking > 0;
		$trainable['vision']    = $available_attacking > 0;
		$trainable['prevision'] = $available_defending > 0;
		$trainable['marking']   = $available_defending > 0;
		
		return $trainable;
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
	
	function PLAYER_upgrade_generic_attribute( $att )
	{
		global $_player_id;
		
		$generic_atts = [ 'strength', 'movement', 'skill' , 'attacking' , 'defending' ];
		
		if ( in_array( $att, $generic_atts ) )
		{
			SQL_prep_stmt_one( 'UPDATE generic_attributes SET '.$att.' = '.$att.' + 1, available_points = available_points - 1 WHERE player_id = ? AND available_points > 0', array( $_player_id ));
		}
	}
	
	function PLAYER_upgrade_playing_attribute( $att )
	{
		global $_player_id;
		
		// Find $att in a certain array and return the corresponding SQL condition for upgrade.
		$trainable_condition = match( true )
		{
			in_array( $att, [ 'speed'    , 'agility' ] )                 => 'movement  > speed     + agility',
			in_array( $att, [ 'airplay'  , 'power'   ] )                 => 'strength  > airplay   + power',
			in_array( $att, [ 'dribble'  , 'pass', 'shoot', 'tackle' ] ) => 'skill     > dribble   + pass    + shoot + tackle',
			in_array( $att, [ 'position' , 'vision'  ] )                 => 'attacking > position  + vision',
			in_array( $att, [ 'prevision', 'marking' ] )                 => 'defending > prevision + marking',
			default => null
		};
		
		// $trainable_condition is null if $att was not found.
		if ( $trainable_condition != null )
		{
			// -- DB operation --
			SQL_prep_stmt_result(
				'UPDATE   football_players   f
				JOIN      playing_attributes p  ON  p.player_id =  f.id
				JOIN      generic_attributes g  ON  g.player_id =  f.id
				JOIN      player_team        pt ON pt.player_id =  f.id
				LEFT JOIN teams              t  ON  t.id        = pt.team_id
				SET
					'.$att.' = '.$att.' + 1,
					f.rating = f.rating + 1,
					t.rating = t.rating + 1
				WHERE f.id = ? AND '.$trainable_condition,
				array( $_player_id ) );
		}
	}