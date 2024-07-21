<?php

	// -- Search Functions --
	
	// Include other functions.
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_sql_functions;
	
	// -- Functions --
	
	function SEARCH_player_by_name( $player_name )
	{
		// -- Handle Input --
		
		$check_search_name = INPUT_handle_search_name( $player_name );
		
		// Exit if input isn't valid.
		if ( $check_search_name['failed'] ) return true;
		
		$player_name_handled = $check_search_name['handled'];
		
		// -- DB operation --
		
		$sql_search_pattern = '%'.$player_name_handled.'%';
		
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id          as player_id,
				f.player_name,
				f.rating,
				t.id          as team_id,
				t.team_name
			FROM game_users u
			JOIN football_players f ON f.id        = u.id
			JOIN player_team      p ON p.player_id = f.id
			LEFT JOIN teams       t ON t.id        = p.team_id
			WHERE f.player_name LIKE ?',
			array( $sql_search_pattern ) );
	}
	
	function SEARCH_team_by_name( $team_name )
	{
		// -- Handle Input --
		
		$check_search_name = INPUT_handle_search_name( $team_name );
		
		// Exit if input isn't valid.
		if ( $check_search_name['failed'] ) return true;
		
		$team_name_handled = $check_search_name['handled'];
		
		// -- DB operation --
		
		$sql_search_pattern = '%'.$team_name_handled.'%';
		
		return SQL_prep_get_multi(
			'SELECT
				id          as team_id,
				team_class,
				team_name,
				rating,
				members
			FROM teams
			WHERE team_name LIKE ?',
			array( $sql_search_pattern ) );
	}