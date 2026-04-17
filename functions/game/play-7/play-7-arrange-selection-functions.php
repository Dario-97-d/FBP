<?php

	// -- Play-7 Arrange Selection functions --
	
	require_once $_FILEREF_play_7_functions;
	
	// -- Functions --
  
  function PLAY_7_Arrange_Selection_deselect_player( $deselected_id )
  {
    global $_player_id;
    
    return SQL_prep_stmt_one(
      "DELETE FROM play7_selections
      WHERE        team_id = (
        SELECT team_id FROM player_team WHERE player_id = ?
      )
      AND player_id = ?",
      array( $_player_id, $deselected_id ) );
  }
  
  function PLAY_7_Arrange_Selection_get_all_players()
  {
    global $_player_id;
    
    return SQL_prep_get_multi(
      "SELECT
        f.id as player_id,
        f.player_name,
        s.position_number
      FROM  football_players f
      JOIN  player_team      p ON p.player_id = f.id
      JOIN  teams            t ON t.id        = p.team_id
      JOIN  player_team      z ON z.team_id   = t.id
      LEFT JOIN play7_selections s ON s.player_id = f.id
      WHERE z.player_id = ?
      ORDER BY
        s.position_number,
        f.id",
      array( $_player_id ) );
  }
  
  function PLAY_7_Arrange_Selection_get_available_positions( $positions, $selected_players )
  {
    foreach ( $selected_players as $selected )
    {
      if ( $selected['position_number'] !== null )
      {
        unset( $positions[$selected['position_number']] );
      }
    }
    
    return $positions;
  }
  
  function PLAY_7_Arrange_Selection_get_selected( $team_players )
  {
    return array_filter( $team_players, function ($p)
    {
      return $p['position_number'] !== null;
    });
  }
  
  function PLAY_7_Arrange_Selection_get_unselected( $team_players )
  {
    return array_filter( $team_players, function ($p) {
      return $p['position_number'] === null;
    });
  }
  
  function PLAY_7_Arrange_Selection_select_player( $selected_id, $position_number )
  {
    global $_player_id;
    
    // -- Handle Input --
		
		// Exit if id isn't valid.
		if ( ! INPUT_is_id_valid( $selected_id ) ) return false;
    
    // Exit if position_number isn't valid.
    if ( ! ctype_digit( $position_number ) || $position_number < 0 || $position_number > 7 ) return false;
    
    // -- DB operation --
    $select = SQL_prep_stmt_one(
      "INSERT INTO play7_selections (
        team_id,
        player_id,
        position_number
      )
      VALUES (
        (
          SELECT id
          FROM   teams       t
          JOIN   player_team p ON p.team_id = t.id
          WHERE  p.player_id = ?
        ),
        ?,
        ?
      )",
      array( $_player_id, $selected_id, $position_number ) );
    
    return true;
  }
  