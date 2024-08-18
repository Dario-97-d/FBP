<?php

	// -- Play 5 Arrange functions --
	
	require_once $_FILEREF_play_5_functions;
	
	// -- Functions --
	
	function PLAY_5_Arrange_add_to_selection( $players_ids )
	{
		global $_player_id;
		
		// Check whether the given input is an array.
		if ( ! is_array( $players_ids ) ) return false;
		
		foreach ( $players_ids as $id )
		{
			// Continue loop if current id isn't valid.
			if ( ! INPUT_is_id_valid( $id ) ) continue;
			
			// Continue loop if current id is the player's own id.
			if ( $id == $_player_id ) continue;
			
			// -- DB operation --
			SQL_prep_procedure( 'CALL sp_play5_add_to_selection(?, ?)', array( $_player_id, $id ) );
		}
		
		return true;
	}
	
	function PLAY_5_Arrange_get_teammates_for_selection()
	{
		global $_player_id;
		global $_team_id;
		
		return SQL_prep_get_multi(
			'SELECT
				f.*,
				g.*
			FROM      football_players   f
			JOIN      generic_attributes g ON g.player_id = f.id
			JOIN      player_team        t ON t.player_id = f.id
			LEFT JOIN play5_selections   s ON s.player_id = ? AND s.selected_id = f.id
			WHERE f.id          <> ?
			AND   t.team_id      = ?
			AND   s.selected_id IS NULL',
			array( $_player_id, $_player_id, $_team_id ) );
	}
	
	function PLAY_5_Arrange_select_gk_bot( $bool_select )
	{
		global $_player_id;
		
		if ( $bool_select )
		{
			$select = SQL_prep_stmt_one( 'INSERT INTO play5_selections () VALUES (?, ?)', array( $_player_id, $_player_id ) );
			
			return RESULT_is_success( $select );
		}
		else
		{
			$deselect = SQL_prep_stmt_one( 'DELETE FROM play5_selections WHERE player_id = ? and selected_id = ?', array( $_player_id, $_player_id ) );
			
			return RESULT_is_success( $deselect );
		}
	}