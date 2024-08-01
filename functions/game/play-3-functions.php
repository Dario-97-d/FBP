<?php

	// -- Play-3 Functions --
	
	function PLAY_3_result( $own_score, $bot_score, $upgrade, $complementarity_index )
	{
		return array(
			'own_score'       => $own_score,
			'bot_score'       => $bot_score,
			'upgrade'         => $upgrade,
			'complementarity' => $complementarity_index );
	}
	
	function PLAY_3( $player, $partner )
	{
		// -- 3-a-side Game --
		
		/*
			Evaluate the complementarity of the players
			and award the player with one available point
			for generic attribute upgrade.
		*/
		
		$combined_strength  = $player['strength']  + $partner['strength'] ;
		$combined_movement  = $player['movement']  + $partner['movement'] ;
		$combined_skill     = $player['skill']     + $partner['skill']    ;
		$combined_attacking = $player['attacking'] + $partner['attacking'];
		$combined_defending = $player['defending'] + $partner['defending'];
		
		// -- Physical and Tactical Complementarity --
		
		$physical_imbalance = abs( $combined_strength  - $combined_movement );
		$tactical_imbalance = abs( $combined_attacking - $combined_defending );
		
		$total_imbalance = $physical_imbalance + $tactical_imbalance;
		
		// -- Rating difference --
		$diff_rating = abs( $player['rating'] - $partner['rating'] );
		
		// -- Partial Indexes --
		
		$rating_index  = 1 / ( 0.2 * $diff_rating     + 1 );
		$balance_index = 1 / ( 0.1 * $total_imbalance + 1 );
		
		// -- Complementarity Index --
		$complementarity_index = round( $rating_index * $balance_index, 2 );
		
		// -- Generate values for game result --
		
		$own_random_factor = rand( 0, 5 );
		$bot_random_factor = rand( 0, 5 );
		
		$goal_propensity = ( $combined_skill + $combined_attacking ) / ( $combined_skill + $combined_attacking + $combined_defending );
		
		$own_score =  round( $goal_propensity * ( $own_random_factor + 5 * $complementarity_index ) );
		$bot_score =  round( $goal_propensity * ( $bot_random_factor + 5 * ( 1 - $complementarity_index ) ) );
		
		// -- Award 1 Available point if players complement each other --
		$upgrade = match( true )
		{
			( $complementarity_index > .5 ) => 1,
			( $complementarity_index < .5 ) => -1,
			default => 0
		};
		
		return PLAY_3_result( $own_score, $bot_score, $upgrade, $complementarity_index );
	}