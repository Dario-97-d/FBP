<?php

  // -- Play-7 functions --

  // Require other functions.
  require_once $_FILEREF_sql_functions;

  // -- Functions --

  function PLAY_7_get_positions()
  {
    global $_player_id;
    
    $current_formation = SQL_prep_get_value(
      'SELECT f.formation
      FROM    play7_formations f
      JOIN    player_team      p ON p.team_id = f.team_id
      WHERE   p.player_id = ?',
      array( $_player_id ) );
    
    if ( ! in_array( $current_formation, [ '2-3-1', '1-3-2' ] ) )
    {
      return false;
    }
    
    return match( $current_formation )
    {
      '2-3-1' => [ 'GK', 'RB', 'LB', 'CDM', 'RWF', 'LWF', 'CF' ],
      '1-3-2' => [ 'GK', 'CB', 'RWB', 'LWB', 'CAM', 'RF', 'LF' ],
      default => false
    };
  }
  
  function PLAY_7_switch_formation()
  {
    global $_player_id;
    
    return SQL_prep_stmt_one(
      "UPDATE play7_formations f
      JOIN    player_team      p ON p.team_id = f.team_id
      SET     f.formation = (
        IF( f.formation = '2-3-1', '1-3-2', '2-3-1')
      )
      WHERE p.player_id = ?",
      array( $_player_id ) );
  }