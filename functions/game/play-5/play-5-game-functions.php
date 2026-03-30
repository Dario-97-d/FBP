<?php

	// -- Play-5 Game functions --
	
	require_once $_FILEREF_play_5_functions;
	
	// -- Functions --
	
	function PLAY_5_Game_result( $balance, $positions, $score, $upgrade )
	{
		return array(
			'balance'           => $balance,
			'positions_players' => $positions['players'],
			'positions_bots'    => $positions['bots'],
			'own_score'         => $score['own_score'],
			'bot_score'         => $score['bot_score'],
			'upgrade'           => $upgrade
		);
	}
	
	function PLAY_5_Game( &$selected_players, $total_atts )
	{
		if ( count( $selected_players ) !== 5 ) return false;
		
		// -- Order Players --
		
		// Determine Attack/Defense ratio of players.
		foreach ( $selected_players as &$player )
		{
			$player['atk_dfs_ratio'] = $player['attacking'] / ( $player['attacking'] + $player['defending'] );
		}
		
		// Sort players by Attack/Defense ratios and rating.
		PLAY_5_Game_sort_players( $selected_players );
		
		// -- Set formation --
		
		$formation = PLAY_5_Game_determine_formation( $selected_players );
		
		// -- Set variables for display --
		
		$positions_for_1_2_1 = [ 'GK', 'CB', 'RM', 'LM', 'CF' ];
		$positions_for_2_2   = [ 'GK', 'RB', 'LB', 'RF', 'LF' ];
		
		$positions = array(
			'players' => $formation == '1-2-1' ?  $positions_for_1_2_1 : $positions_for_2_2,
			'bots'    => rand( 0, 1 )          ?  $positions_for_1_2_1 : $positions_for_2_2,
		);
		
		// Add positions to selected_players array.
		$i = 0;
		foreach ( $selected_players as &$player )
		{
			$player['position'] = $positions['players'][$i];
			$i++;
		}
		
		$balance['physical'] = PLAY_5_Game_calculate_physical_balance( $total_atts );
		$balance['tactical'] = PLAY_5_Game_calculate_tactical_balance( $total_atts );
		$balance['overall'] = ( $balance['physical'] ** 0.5 ) * ( $balance['tactical'] ** 0.5 );
		
		$score = PLAY_5_Game_produce_game_score( $balance, $total_atts );
		
		$upgrade = $balance['overall'] > .75;
		
		return PLAY_5_Game_result( $balance, $positions, $score, $upgrade );
	}
	
	function PLAY_5_Game_calculate_physical_balance( $total_atts )
	{
		$total_atts_without_skill = $total_atts['rating'] - $total_atts['skill'];
		$avg_att_without_skill = $total_atts_without_skill / 4;
		
		$physical_sum    =      $total_atts['strength'] + $total_atts['movement'];
		$physical_diff   = abs( $total_atts['strength'] - $total_atts['movement'] );
		
		$physical_to_avg = abs( $physical_sum - ( 2 * $avg_att_without_skill ) );
		
		$physical_inner_imbalance = $physical_diff   / 5;
		$physical_outer_imbalance = $physical_to_avg / 10;
		
		return 1 / ( ( $physical_inner_imbalance + $physical_outer_imbalance ) / 9 + 1 );
	}
	
	function PLAY_5_Game_calculate_tactical_balance( $total_atts )
	{
		$total_atts_without_skill = $total_atts['rating'] - $total_atts['skill'];
		$avg_att_without_skill = $total_atts_without_skill / 4;
		
		$tactical_sum  =      $total_atts['attacking'] + $total_atts['defending'];
		$tactical_diff = abs( $total_atts['attacking'] - $total_atts['defending'] );
		
		$tactical_to_avg = abs( $tactical_sum - ( 2 * $avg_att_without_skill ) );
		
		$tactical_inner_imbalance = $tactical_diff   / 5;
		$tactical_outer_imbalance = $tactical_to_avg / 10;
		
		return 1 / ( ( $tactical_inner_imbalance + $tactical_outer_imbalance ) / 9 + 1 );
	}
	
	function PLAY_5_Game_determine_formation( $selected_players )
	{
		/*
			Determine formation based on rating and attack/defense ratios.
		*/
		
		// Determine ratio differences between consecutive players.
		$ratio_diff_back   = $selected_players[2]['atk_dfs_ratio'] - $selected_players[1]['atk_dfs_ratio'];
		$ratio_diff_middle = $selected_players[3]['atk_dfs_ratio'] - $selected_players[2]['atk_dfs_ratio'];
		$ratio_diff_front  = $selected_players[4]['atk_dfs_ratio'] - $selected_players[3]['atk_dfs_ratio'];
		
		// Choose formation by attack/defense ratios of players.
		if ( $ratio_diff_middle > $ratio_diff_front && $ratio_diff_middle > $ratio_diff_back )
		{
			return '2-2';
		}
		else if ( $ratio_diff_front > ( $ratio_diff_middle + $ratio_diff_back ) || $ratio_diff_back > ( $ratio_diff_front + $ratio_diff_middle ) )
		{
			return '1-2-1';
		}
		else if ( $ratio_diff_middle > $ratio_diff_front || $ratio_diff_middle > $ratio_diff_back )
		{
			return '2-2';
		}
		else if ( $ratio_diff_front > $ratio_diff_middle || $ratio_diff_back > $ratio_diff_middle )
		{
			return '1-2-1';
		}
		else if ( $ratio_diff_middle > 0 )
		{
			return '2-2';
		}
		else
		{
			// Determine rating differences between consecutive players.
			$rating_diff_front  = abs( $selected_players[2]['rating'] - $selected_players[1]['rating'] );
			$rating_diff_middle = abs( $selected_players[3]['rating'] - $selected_players[2]['rating'] );
			$rating_diff_back   = abs( $selected_players[4]['rating'] - $selected_players[3]['rating'] );
			
			// Choose formation by ratings of players.
			if ( $rating_diff_middle > $rating_diff_front && $rating_diff_middle > $rating_diff_back )
			{
				return '2-2';
			}
			else if ( $rating_diff_front > ( $rating_diff_middle + $rating_diff_back ) || $rating_diff_back > ( $rating_diff_front + $rating_diff_middle ) )
			{
				return '1-2-1';
			}
			else if ( $rating_diff_middle > $rating_diff_front || $rating_diff_middle > $rating_diff_back )
			{
				return '2-2';
			}
			else if ( $rating_diff_front > $rating_diff_middle || $rating_diff_back > $rating_diff_middle )
			{
				return '1-2-1';
			}
			else if ( $rating_diff_middle > 0 )
			{
				return '2-2';
			}
		}
		
		// Choose random formation if not set yet.
		return rand( 0, 1 ) ? '1-2-1' : '2-2';
	}
	
	function PLAY_5_Game_produce_game_score( $balance, $total_atts )
	{
		$goal_propensity = ( 1 + rand( 1, 5 ) / 5 ) * ( $total_atts['skill'] + $total_atts['attacking'] ) / ( $total_atts['skill'] + $total_atts['attacking'] + $total_atts['defending'] );
		
		$random_min_goals = rand( 0, 3 );
		
		$own_score = $random_min_goals + round( 5 * $goal_propensity * $balance['overall'] );
		$bot_score = $random_min_goals + round( 5 * $goal_propensity * ( 1 - $balance['overall'] ) );
		
		return array(
			'own_score' => $own_score,
			'bot_score' => $bot_score
		);
	}
	
	function PLAY_5_Game_sort_players( &$selected_players )
	{
		/*
			Sort selected players by Attack/Defense ratio, then by rating.
		*/
		
		// -- Remove GK --
		
		// If GK Bot isn't selected,
		// sort selected_players by rating, skill and movement.
		if ( $selected_players[0]['player_id'] !== 0 )
		{
			usort(
				$selected_players,
				function ( $a, $b )
				{					
					if ( $a['rating'] == $b['rating'] )
					{
						if ( $a['skill'] == $b['skill'] )
						{
							if ( $a['movement'] == $b['movement'])
							{
								return $a['attacking'] <=> $b['attacking'];
							}
							
							return $a['movement'] <=> $b['movement'];
						}
						
						return $a['skill'] <=> $b['skill'];
					}
					
					return $a['rating'] <=> $b['rating'];
				}
			);
		}
		
		// Get GK Bot or worst / slowest / least offensive player,
		// and remove from the array to be sorted.
		$gk = array_shift( $selected_players );
		
		// -- Final Sorting --
		
		// Sort by Atk/Dfs ratio, then by Rating.
		usort(
			$selected_players,
			function ( $a, $b )
			{
				if ( $a['atk_dfs_ratio'] == $b['atk_dfs_ratio'] )
				{
					return $b['defending'] <=> $a['defending'];
				}
				
				return $a['atk_dfs_ratio'] <=> $b['atk_dfs_ratio'];
			}
		);
		
		// Insert the GK back.
		array_unshift( $selected_players, $gk );
	}
	
	function PLAY_5_Game_update_player_on_result( $result )
	{
		global $_player_id;
		
		$is_upgrade = $result['upgrade'] == true;
		$is_win     = $result['own_score'] > $result['bot_score'];
		
		$update = SQL_prep_stmt_result(
			'UPDATE football_players   f
			JOIN    player_stats       s ON s.player_id = f.id
			JOIN    generic_attributes g ON g.player_id = f.id
			SET
				s.play5_games = s.play5_games + 1'
				.( $is_win     ? ', s.play5_wins       = s.play5_wins + 1'                 : '' )
				.( $is_upgrade ? ', g.available_points = LEAST( g.available_points + 1, 5 )' : '' ).
			' WHERE s.player_id = ?
			AND     f.rating    < 61',
			array( $_player_id ) );
		
		return RESULT_is_success( $update );
	}