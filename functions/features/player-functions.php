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
	
	function PLAYER_get_generic_attributes_from_player( $player )
	{
		return array(
			'rating'    => $player['rating'],
			'strength'  => $player['strength'],
			'movement'  => $player['movement'],
			'skill'     => $player['skill'],
			'attacking' => $player['attacking'],
			'defending' => $player['defending']);
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
	
	function PLAYER_has_team()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_bool_or_null( 'SELECT 1 FROM player_team WHERE player_id = ? AND team_id IS NOT NULL', array( $_player_id ) );
	}