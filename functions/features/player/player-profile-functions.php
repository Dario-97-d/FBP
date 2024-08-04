<?php

	// -- Player Development functions --
	
	require_once $_FILEREF_player_functions;
	
	// -- Functions --
	
	function PLAYER_Profile_get( $player_id )
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
	
	function PLAYER_Profile_get_mate_status( $checked_id )
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
	
	function PLAYER_Profile_is_invite_allowed()
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