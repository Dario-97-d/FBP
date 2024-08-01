<?php

	// $sets_of_atts = array(
		// [ 5, 5, 5, 5, 5 ],
		// [ 6, 5, 5, 5, 5 ],
		// [ 5, 6, 5, 5, 5 ],
		// [ 5, 5, 5, 6, 5 ],
		// [ 5, 5, 5, 5, 6 ],
		// [ 6, 5, 6, 5, 5 ],
		// [ 5, 6, 6, 5, 5 ],
		// [ 5, 5, 6, 6, 5 ],
		// [ 5, 5, 6, 5, 6 ],
		// [ 6, 5, 5, 6, 5 ],
		// [ 5, 6, 5, 5, 6 ],
		// [ 6, 5, 5, 5, 6 ],
		// [ 5, 6, 5, 6, 5 ],
		// [ 6, 5, 6, 6, 5 ],
		// [ 5, 6, 6, 5, 6 ],
		// [ 6, 5, 6, 5, 6 ],
		// [ 5, 6, 6, 6, 5 ],
		// [ 6, 6, 5, 6, 6 ],
		// [ 6, 6, 6, 6, 6 ],
		// [ 6, 6, 5, 5, 5 ],
		// [ 5, 5, 5, 6, 6 ],
		// [ 6, 6, 6, 5, 5 ],
		// [ 5, 5, 6, 6, 6 ],
	// );
	
	// for ( $a = 0; $a < 2; $a++ )
	// {
		// for ( $b = 0; $b < 2; $b++ )
			// for ( $c = 0; $c < 2; $c++ )
				// for ( $d = 0; $d < 2; $d++ )
					// for ( $e = 0; $e < 2; $e++ )
					// {
						// $sets_of_atts[] = [ 5 + $a, 5 + $b, 5 + $c, 5 + $d, 5 + $e ];
					// }
	// }
	
	$sets_of_atts = array(
		[  9, 11, 15, 10, 5 ],
		[  5, 12, 18, 10, 5 ],
		[  5, 10, 20, 10, 5 ],
		[  6,  6, 21, 11, 6 ],
		[  7, 10, 20,  6, 5 ],
		[  6,  6, 20, 12, 5 ],
		[  5, 11, 19, 10, 5 ],
		[  5, 10, 19, 10, 6 ],
		[ 13,  8, 16,  8, 5 ],
		[  5,  6, 20, 10, 9 ],
		[ 10,  5, 20,  5, 10 ],
		[ 13,  8,  8,  8, 13 ],
		[ 11,  9,  5, 10, 15 ],
		[  8, 13,  5, 13, 16 ],
		[ 10, 10, 15, 10,  5 ],
	);
	
	$string = '<table id="tabela" style="text-align: center;">';
	
	// Header.
	$string .= '<thead>';
	$string .= '<tr>';
	$string .= '<th>vs</th>';
	$string .= '<th>R</th>';
	$string .= '<th>DR</th>';
	$string .= '<th>CR</th>';
	$string .= '<th>Avg</th>';
	$string .= '<th>PImb</th>';
	$string .= '<th>TImb</th>';
	$string .= '<th>ImbT</th>';
	$string .= '<th>RtgI</th>';
	$string .= '<th>BalI</th>';
	$string .= '</tr>';
	$string .= '</thead>';
	
	foreach ( $sets_of_atts as $player )
	{
		foreach ( $sets_of_atts as $partner )
		{
			$combined_rating = array_sum( $player ) + array_sum( $partner );
			
			$combined_strength  = $player[0] + $partner[0];
			$combined_movement  = $player[1] + $partner[1];
			$combined_skill     = $player[2] + $partner[2];
			$combined_attacking = $player[3] + $partner[3];
			$combined_defending = $player[4] + $partner[4];
			
			$diff_rating = abs( array_sum( $player ) - array_sum( $partner ) );
			
			$physical_imbalance = abs( ( $combined_strength  - $combined_movement  ) );
			$tactical_imbalance = abs( ( $combined_attacking - $combined_defending ) );
			
			$total_imbalance = $physical_imbalance + $tactical_imbalance;
			
			$rating_index  = round( 1 / ( 0.2  * $diff_rating     + 1 ), 2 );
			$balance_index = round( 1 / ( 0.1  * $total_imbalance + 1 ), 2 );
			
			$result = $rating_index * $balance_index;
			
			// -- Prepare string --
			
			$string .= '<tr id="outer">';
			
			// Inner table for the "vs" column.
			$string .= '<td>';
			$string .= '<table>';
			$string .= '<tr>';
			foreach ( $player as $att )
			{
				$string .= '<td width="32px">'.$att.'</td>';
			}
			$string .= '</tr>';
			$string .= '<tr>';
			foreach ( $partner as $att )
			{
				$string .= '<td width="32px">'.$att.'</td>';
			}
			$string .= '</tr>';
			$string .= '</table>';
			$string .= '</td>';
			
			$string .= '<th width="32px" id="result">' . $result . '</th>';
			
			$string .= '<th width="32px" id="diff-rating">' . $diff_rating . '</th>';
			$string .= '<td width="32px">' . $combined_rating . '</td>';
			$string .= '<td width="32px">' . $combined_rating / 5 . '</td>';
			
			$string .= '<td width="32px">' . $physical_imbalance . '</td>';
			$string .= '<td width="32px">' . $tactical_imbalance . '</td>';
			
			$string .= '<th width="32px" id="total-imbalance">' . $total_imbalance . '</th>';
			
			$string .= '<th width="32px" id="rating-index">' .  $rating_index . '</th>';
			$string .= '<th width="32px" id="balance-index">' . $balance_index . '</th>';
			
			$string .= '</tr>';
		}
	}

	echo $string . '</table>';
	
	echo
		'
			<script>
				
				const table = document.getElementById("tabela");
				const tbody = table.querySelector("tbody");
				const rows = Array
					.from( tbody.querySelectorAll("tr#outer") );
				
				rows.sort((rowA, rowB) => {
					
					const cellA1 = rowA.querySelector("th#result").innerHTML;
					const cellB1 = rowB.querySelector("th#result").innerHTML;
					
					const cellA2 = rowA.querySelector("th#rating-index").innerHTML;
					const cellB2 = rowB.querySelector("th#rating-index").innerHTML;
					
					const cellA3 = rowA.querySelector("th#balance-index").innerHTML;
					const cellB3 = rowB.querySelector("th#balance-index").innerHTML;
					
					if ( cellA1 === cellB1 )
					{
						if ( cellA2 === cellB2 )
						{
							if ( cellA3 === cellB3 )
							{
								//return cellA4 - cellB4;
							}
							return cellA3 - cellB3;
						}
						return cellA2 - cellB2;
					}
					return cellB1 - cellA1;
					
				});
				
				rows.forEach(row => tbody.appendChild(row));
				
			</script>
		';