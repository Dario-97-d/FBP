<?php

  // -- Play-5 functions --

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
      Get selected players, including GK bot and other bots.
      GK bot has id 0.
      Other bots have id < 0.
    */

    $selected_players = SQL_prep_get_multi(
      "SELECT
        s.selected_id as player_id,

        CASE
          WHEN s.selected_id > 0 THEN f.player_name
          WHEN s.selected_id = 0 THEN 'GK (bot)'
          ELSE                        'Sohm (bot)'
        END AS player_name,

        CASE
          WHEN s.selected_id > 0 THEN f.rating
          ELSE 0
        END AS rating,

        CASE
          WHEN s.selected_id > 0 THEN g.strength
          ELSE 0
        END AS strength,

        CASE
          WHEN s.selected_id > 0 THEN g.movement
          ELSE 0
        END AS movement,

        CASE
          WHEN s.selected_id > 0 THEN g.skill
          ELSE 0
        END AS skill,

        CASE
          WHEN s.selected_id > 0 THEN g.attacking
          ELSE 0
        END AS attacking,

        CASE
          WHEN s.selected_id > 0 THEN g.defending
          ELSE 0
        END AS defending
      FROM       play5_selections   s
      LEFT JOIN  football_players   f ON f.id          = s.selected_id
      LEFT JOIN  generic_attributes g ON g.player_id   = f.id
      LEFT JOIN  player_team        t ON t.player_id   = f.id
      WHERE s.player_id = ?
      ORDER BY
        s.selected_id = 0 DESC,
        t.team_id     = ? DESC,
        f.rating          DESC,
        f.id          > 0",
      array( $_player_id, $_team_id ) );

    // Return false if something went wrong.
    if ( ! $selected_players ) return false;

    // If there aren't selected players, return array with the player.
    if ( $selected_players === true )
    {
      // -- Success 1/2 --
      return array( $player );
    }

    // -- Manage selection of bots --

    $base_att_value = floor( $player['rating'] / 10 );

    // GK - Bot has id 0.
    if ( $selected_players[0]['player_id'] === 0 )
    {
      $selected_players[0]['strength']  = 2 * $base_att_value;
      $selected_players[0]['movement']  = $base_att_value;
      $selected_players[0]['skill']     = $base_att_value;
      $selected_players[0]['attacking'] = $base_att_value;
      $selected_players[0]['defending'] = $player['rating'] - 5 * $base_att_value;
      $selected_players[0]['rating']    = 5 * $base_att_value + ( $player['rating'] - 5 * $base_att_value );

      // Insert player after GK.
      array_splice( $selected_players, 1, 0, [ $player ] );
    }
    else
    {
      // Insert player at the start.
      array_unshift( $selected_players, $player );
    }

    foreach ( $selected_players as &$selected_player )
    {
      // Bots have id < 0.
      if ( $selected_player['player_id'] < 0 )
      {
        $att_value = 2 * $base_att_value;

        $selected_player['strength']  = $att_value;
        $selected_player['movement']  = $att_value;
        $selected_player['skill']     = $att_value;
        $selected_player['attacking'] = $att_value;
        $selected_player['defending'] = $att_value;
        $selected_player['rating'] = 10 * $base_att_value;
      }
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
