<?php

	// -- Play-5 Functions --
	
	// Require other functions.
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_result_functions;
	require_once $_FILEREF_sql_functions;
	
	// -- Functions --
	
	function PLAY_5_clear_selection()
	{
		global $_player_id;
		
		$clear = SQL_prep_stmt_result('DELETE FROM play5_selections WHERE player_id = ?', array( $_player_id ) );
		
		return RESULT_is_success( $clear );
	}
	
	function PLAY_5_get_player()
	{
		global $_player_id;
		
		return SQL_prep_get_row(
			'SELECT
				f.*,
				g.*
			FROM football_players   f
			JOIN generic_attributes g ON g.player_id = f.id
			WHERE f.id = ?',
			array( $_player_id ) );
	}
	
	function PLAY_5_get_selected_players( $player )
	{
		global $_player_id;
		global $_team_id;
		
		/*
			Get selected players and determine whether GK - Bot is selected.
			GK - Bot selection is player selecting itself.
		*/
		
		$selected_players = SQL_prep_get_multi(
			'SELECT
				f.player_name,
				f.rating,
				g.*
			FROM      football_players   f
			JOIN      generic_attributes g ON g.player_id   = f.id
			LEFT JOIN play5_selections   s ON s.selected_id = f.id
			LEFT JOIN player_team        t ON t.player_id   = f.id
			WHERE     s.player_id = ?
			ORDER BY
				f.id      = ? DESC,
				t.team_id = ? DESC,
				f.rating      DESC,
				f.id          ASC',
			array( $_player_id, $_player_id, $_team_id ) );
		
		// Return false if something went wrong.
		if ( ! $selected_players ) return false;
		
		// If there aren't selected players, return array with the player.
		if ( $selected_players === true )
		{
			// -- Success 1/2 --
			return array( $player );
		}
		
		// -- Manage selection of GK - Bot --
		
		// If first selected player is the player itself, the GK - Bot is selected.
		if ( $selected_players[0]['player_id'] == $_player_id )
		{
			$att_unit = round( $selected_players[0]['rating'] / 10 );
			
			$selected_players[0]['player_name'] = 'GK - Bot';
			$selected_players[0]['strength']  = 2 * $att_unit;
			$selected_players[0]['movement']  = $att_unit;
			$selected_players[0]['skill']     = $att_unit;
			$selected_players[0]['attacking'] = $att_unit;
			$selected_players[0]['defending'] = $selected_players[0]['rating'] - 5 * $att_unit;
			
			// Insert player after GK.
			array_splice( $selected_players, 1, 0, [ $player ] );
		}
		else
		{
			// Insert player at the start.
			array_unshift( $selected_players, $player );
		}
		
		// -- Success 2/2 --
		return $selected_players;
	}
	
	function PLAY_5_get_team_id()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_get_value( 'SELECT team_id FROM player_team WHERE player_id = ?', array( $_player_id ) );
	}
	
	function PLAY_5_get_total_atts( $selected_players )
	{
		$total_atts = array(
			'strength'  => 0,
			'movement'  => 0,
			'skill'     => 0,
			'attacking' => 0,
			'defending' => 0,
			'rating'    => 0
		);
		
		foreach ( $selected_players as $selected )
		{
			$total_atts['strength']  += $selected['strength'];
			$total_atts['movement']  += $selected['movement'];
			$total_atts['skill']     += $selected['skill'];
			$total_atts['attacking'] += $selected['attacking'];
			$total_atts['defending'] += $selected['defending'];
			$total_atts['rating']    += $selected['rating'];
		}
		
		return $total_atts;
	}
	
	function PLAY_5_is_bot_selected( $selected_players )
	{
		/*
			Bot is selected if first selected player is 'bot'.
		*/
		
		return isset( $selected_players[0] ) && $selected_players[0]['player_name'] == 'GK - Bot';
	}