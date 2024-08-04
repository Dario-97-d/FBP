<?php

	// -- Player Development functions --
	
	require_once $_FILEREF_player_functions;
	
	// -- Functions --
	
	function PLAYER_Development_get_attributes()
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
	
	function PLAYER_Development_get_upgradeable_atts( $player )
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
		
		$upgradeable = array();
		
		$upgradeable['speed']     = $available_movement  > 0;
		$upgradeable['agility']   = $available_movement  > 0;
		$upgradeable['airplay']   = $available_strength  > 0;
		$upgradeable['power']     = $available_strength  > 0;
		$upgradeable['dribble']   = $available_skill     > 0;
		$upgradeable['pass']      = $available_skill     > 0;
		$upgradeable['shoot']     = $available_skill     > 0;
		$upgradeable['tackle']    = $available_skill     > 0;
		$upgradeable['position']  = $available_attacking > 0;
		$upgradeable['vision']    = $available_attacking > 0;
		$upgradeable['prevision'] = $available_defending > 0;
		$upgradeable['marking']   = $available_defending > 0;
		
		return $upgradeable;
	}
	
	function PLAYER_Development_upgrade_generic_attribute( $att )
	{
		global $_player_id;
		
		$generic_atts = [ 'strength', 'movement', 'skill' , 'attacking' , 'defending' ];
		
		if ( in_array( $att, $generic_atts ) )
		{
			$upgrade = SQL_prep_stmt_result(
				'UPDATE   football_players   f
				JOIN      generic_attributes g ON g.player_id = f.id
				JOIN      player_team        p ON p.player_id = f.id
				LEFT JOIN teams              t ON t.id        = p.team_id
				SET
					f.rating = f.rating + 1,
					t.rating = t.rating + 1,
					'.$att.' = '.$att.' + 1,
					available_points = available_points - 1
				WHERE f.id = ?
				AND   g.available_points > 0
				AND   f.rating < 60',
				array( $_player_id ));
			
			if ( RESULT_is_success( $upgrade ) )
			{
				return true;
			}
		}
		
		return false;
	}
	
	function PLAYER_Development_upgrade_playing_attribute( $att )
	{
		global $_player_id;
		
		// Find $att in a certain array and return the corresponding SQL condition for upgrade.
		$upgrade_condition = match( true )
		{
			in_array( $att, [ 'speed'    , 'agility' ] )                 => 'movement  > speed     + agility',
			in_array( $att, [ 'airplay'  , 'power'   ] )                 => 'strength  > airplay   + power',
			in_array( $att, [ 'dribble'  , 'pass', 'shoot', 'tackle' ] ) => 'skill     > dribble   + pass    + shoot + tackle',
			in_array( $att, [ 'position' , 'vision'  ] )                 => 'attacking > position  + vision',
			in_array( $att, [ 'prevision', 'marking' ] )                 => 'defending > prevision + marking',
			default => null
		};
		
		// $upgrade_condition is null if $att was not matched.
		if ( $upgrade_condition != null )
		{
			// -- DB operation --
			$upgrade = SQL_prep_stmt_result(
				'UPDATE football_players   f
				JOIN    playing_attributes p  ON  p.player_id =  f.id
				JOIN    generic_attributes g  ON  g.player_id =  f.id
				SET
					'.$att.' = '.$att.' + 1
				WHERE f.id = ?
				AND   '.$upgrade_condition,
				array( $_player_id ) );
			
			if ( RESULT_is_success( $upgrade ) )
			{
				return true;
			}
		}
		
		return false;
	}