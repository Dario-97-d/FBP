<?php

	// -- Team Profile functions --
	
	require_once $_FILEREF_team_functions;
	
	// -- Functions --
	
	function TEAM_Profile_get_player_team_status()
	{
		global $_player_id;
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_value(
			'SELECT
				CASE
					WHEN EXISTS (SELECT 1 FROM player_team              WHERE player_id = ? AND team_id IS NOT NULL) THEN \'has team\'
					WHEN EXISTS (SELECT 1 FROM player_team_applications WHERE player_id = ? AND team_id   = ?)       THEN \'has application\'
					WHEN EXISTS (SELECT 1 FROM team_player_invites      WHERE team_id   = ? AND player_id = ?)       THEN \'has invite\'
					WHEN (
						SELECT   count( player_id )
						FROM     player_team_applications
						WHERE    player_id = ?
						GROUP BY player_id
					) >= 5
						THEN \'has 5 applications\'
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
	
	function TEAM_Profile_get( $team_id )
	{
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return false;
		
		// -- DB operation --
		return SQL_prep_get_row( 'SELECT * FROM teams WHERE id = ?', array( $team_id ) );
	}
	
	function TEAM_Profile_get_members( $team_id )
	{
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return false;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id           as player_id,
				f.player_name,
				f.rating       as player_rating
			FROM  game_users       u
			JOIN  football_players f ON f.id        = u.id
			JOIN  player_team      t ON t.player_id = f.id
			WHERE t.team_id = ?
			ORDER BY
				f.rating     DESC,
				f.id         ASC',
			array( $team_id ) );
	}