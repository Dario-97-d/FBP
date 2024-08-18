<?php

	$sets_of_atts = [];
	
	for ( $a = 0; $a < 4; $a++ )
	{
		for ( $b = 0; $b < 4; $b++ )
		{
			$atk = 5 + $a;
			$dfs = 5 + $b;
			$ratio = round( 100 * $atk / ( $atk + $dfs ) );
			$f_value = 3 * $atk + $dfs;
			$m_value = 2 * ( $atk + $dfs );
			$b_value = $atk + 3 * $dfs;
			$sets_of_atts[] = [ $atk, $dfs , $ratio, $f_value, $m_value, $b_value ];
		}
	}
	
	$combinations_done = array();
	
	$count_sets_of_atts = count( $sets_of_atts );
	
	$string = '<table id="tabela" style="text-align: center;" cellspacing="8">';
	
	$string .= '<tr>';
	$string .= '<th>Team</th>';
	$string .= '<th>Chosen formation</th>';
	$string .= '<th>Choice condition</th>';
	$string .= '</tr>';
	
	foreach ( $sets_of_atts as $key_1 => $player_1 )
	//for ( $a = 0; $a < $count_sets_of_atts; $a++ )
	{
		//$player_1 = $sets_of_atts[$a];
		
		foreach ( $sets_of_atts as $key_2 => $player_2 )
		//for ( $b = $a + 1; $b < $count_sets_of_atts; $b++ )
		{
			//$player_2 = $sets_of_atts[$b];
			
			//if ( $player_1[2] == $player_2[2] ) continue;
			
			foreach ( $sets_of_atts as $key_3 => $player_3 )
			//for ( $c = $b + 1; $c < $count_sets_of_atts; $c++ )
			{
				//$player_3 = $sets_of_atts[$c];
				
				//if ( $player_1[2] == $player_3[2] || $player_2[2] == $player_3[2] ) continue;
				
				foreach ( $sets_of_atts as $key_4 => $player_4 )
				//for ( $d = $c + 1; $d < $count_sets_of_atts; $d++ )
				{
					//if ( $player_1[2] === $player_4[2] || $player_2[2] === $player_4[2] || $player_3[2] === $player_4[2] ) continue;
					
					// -- Prevent repeated unordered combinations --
					
					$combined_keys = array( $key_1, $key_2, $key_3, $key_4 );
					
					sort( $combined_keys );
					
					$current_combination = implode( '', $combined_keys );
					
					if ( in_array( $current_combination, $combinations_done ) ) continue;
					
					$combinations_done[] = $current_combination;
					
					//$player_1 = $sets_of_atts[$a];
					//$player_2 = $sets_of_atts[$b];
					//$player_3 = $sets_of_atts[$c];
					//$player_4 = $sets_of_atts[$d];
					
					$team = [ $player_1, $player_2, $player_3, $player_4 ];
					
					// Define team_players array.
					$team_players = array();
					
					for ( $i = 0; $i < count( $team ); $i++ )
					{
						$team_players[ $i ] = array(
							'atk'        => $team[ $i ][0],
							'dfs'        => $team[ $i ][1],
							'rating'     => $team[ $i ][0] + $team[ $i ][1],
							'ratio'      => $team[ $i ][2],
							'forw_value' => $team[ $i ][3],
							'midd_value' => $team[ $i ][4],
							'back_value' => $team[ $i ][5]
						);
					}
					
					usort(
						$team_players,
						function ( $a, $b )
						{
							if ( $b['ratio'] == $a['ratio'] )
							{
								return $b['rating'] <=> $a['rating'];
							}
							
							return $b['ratio'] <=> $a['ratio'];
						}
					);
					
					$ratio_diff_front  = $team_players[0]['ratio'] - $team_players[1]['ratio'];
					$ratio_diff_middle = $team_players[1]['ratio'] - $team_players[2]['ratio'];
					$ratio_diff_back   = $team_players[2]['ratio'] - $team_players[3]['ratio'];
					
					$rating_diff_front  = abs( $team_players[0]['rating'] - $team_players[1]['rating'] );
					$rating_diff_middle = abs( $team_players[1]['rating'] - $team_players[2]['rating'] );
					$rating_diff_back   = abs( $team_players[2]['rating'] - $team_players[3]['rating'] );
					
					// -- Choose formation
					
					$formation_condition = '';
					if ( $ratio_diff_middle > $ratio_diff_front && $ratio_diff_middle > $ratio_diff_back )
					{
						$formation = '2-2';
						$formation_condition = 'ratio difference is greatest in the middle';
						//continue;
					}
					else if ( $ratio_diff_front > ( $ratio_diff_middle + $rating_diff_back ) || $rating_diff_back > ( $ratio_diff_front + $rating_diff_middle ) )
					{
						$formation = '1-2-1';
						$formation_condition = 'ratio difference at front or back is greater than the others combined';
						//continue;
					}
					else if ( $ratio_diff_middle > $ratio_diff_front || $ratio_diff_middle > $ratio_diff_back )
					{
						$formation = '2-2';
						$formation_condition = 'ratio difference is greater in the middle';
						//continue;
					}
					else if ( $ratio_diff_front > $ratio_diff_middle || $ratio_diff_back > $ratio_diff_middle )
					{
						$formation = '1-2-1';
						$formation_condition = 'ratio difference is greater at the front or back';
						//continue;
					}
					else if ( $ratio_diff_middle > 0 )
					{
						$formation = '2-2';
						$formation_condition = 'there is ratio difference';
						//continue;
					}
					else if ( $rating_diff_middle > $rating_diff_front && $rating_diff_middle > $rating_diff_back )
					{
						$formation = '2-2';
						$formation_condition = 'rating difference is greatest in the middle';
						//continue;
					}
					else if ( $rating_diff_front > ( $rating_diff_middle + $rating_diff_back ) || $rating_diff_back > ( $rating_diff_front + $rating_diff_middle ) )
					{
						$formation = '1-2-1';
						$formation_condition = 'rating difference at front or back is greater than the others combined';
						//continue;
					}
					else if ( $rating_diff_middle > $rating_diff_front || $rating_diff_middle > $rating_diff_back )
					{
						$formation = '2-2';
						$formation_condition = 'rating difference is greater in the middle';
						//continue;
					}
					else if ( $rating_diff_front > $rating_diff_middle || $rating_diff_back > $rating_diff_middle )
					{
						$formation = '1-2-1';
						$formation_condition = 'rating difference is greater at the front or back';
						//continue;
					}
					else if ( $rating_diff_middle > 0 )
					{
						$formation = '2-2';
						$formation_condition = 'there is rating difference';
						//continue;
					}
					else
					{
						$formation = rand( 0, 1 ) ? '1-2-1' : '2-2';
						$formation_condition = 'else';
					}
					
					// -- Table Row --
					
					$string .= '<tr id="outer">';
					
					// Inner table for the team column.
					$string .= '<td>';
					$string .= '<table id="inner" cellpadding="8">';
					
					for ( $i = 0; $i < count( $team ); $i++ )
					{
						$string .= '<tr>';
						$string .= '<td>'.$team_players[ $i ]['atk'].'</td>';
						$string .= '<td>'.$team_players[ $i ]['dfs'].'</td>';
						$string .= '<td>'.$team_players[ $i ]['ratio'].'</td>';
						$string .= '<td>'.$team_players[ $i ]['rating'].'</td>';
						// $string .= '<td>'.$team_players[ $i ]['forw_value'].'</td>';
						// $string .= '<td>'.$team_players[ $i ]['midd_value'].'</td>';
						// $string .= '<td>'.$team_players[ $i ]['back_value'].'</td>';
						// $string .= '<td>'.$team_players[ $i ]['position'].'</td>';
						$string .= '</tr>';
					}
					
					$string .= '</table>';
					$string .= '</td>';
					
					$string .= '<td id="chosen-formation">'.$formation.'</td>';
					$string .= '<td>'.$formation_condition.'</td>';
					
					$string .= '</tr>';
					
				}
			}
		}
	}
	
	
	echo '<body style="background-color: 7f7f7f;">' . $string . '</table>';
	
	// echo
		// '<script>
				// document.querySelectorAll("#tabela").forEach(
					// function (table)
					// {
						// let rows = Array.from(table.querySelectorAll("tr#outer"));
						
						// rows.sort(function(rowA, rowB) {
							// let teamValueA = parseFloat(rowA.querySelectorAll("td#team-value")[0].textContent);
							// let teamValueB = parseFloat(rowB.querySelectorAll("td#team-value")[0].textContent);
							
							// let balancedValueA = parseFloat(rowA.querySelectorAll("td#balanced-value")[0].textContent);
							// let balancedValueB = parseFloat(rowB.querySelectorAll("td#balanced-value")[0].textContent);
							
							// let balancedA =
								// parseFloat(
									// rowA.querySelectorAll(
										// "td#balanced-" +
										// rowA.querySelectorAll(
											// "td#chosen-formation"
										// )[0]
										// .textContent
									// )[0]
									// .textContent
								// );
							
							// let balancedB =
								// parseFloat(
									// rowB.querySelectorAll(
										// "td#balanced-" +
										// rowB.querySelectorAll(
											// "td#chosen-formation"
										// )[0]
										// .textContent
									// )[0]
									// .textContent
								// );
							
							// if ( balancedValueA === balancedValueB )
							// {
								// if ( teamValueA === teamValueB )
								// {
									// return balancedB - balancedA;
								// }
								
								// return teamValueB - teamValueA;
							// }
							
							// return balancedValueB - balancedValueA;
						// });
						
						// // Re-insert sorted rows into the table
						// rows.forEach(row => table.appendChild(row));
					// }
				// );
		// </script>';