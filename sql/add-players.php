<?php

	// [ username, player_name, email ]
	$players_to_add = array(
		array(
			'CrisRock', 'Cristiano Ronaldo', 'cris-rock@e.mail'
		),
		array(
			'LeoMessi19', 'Lionel Messi', 'leo-messi-19@e.mail'
		),
		array(
			'RoniGau', 'Ronaldinho Gaúcho', 'roni-gau@e.mail'
		),
		array(
			'Zinene', 'Zinedine Zidane', 'zinene@e.mail'
		),
		array(
			'IlFeno', 'Ronaldo Nazaario', 'il-feno@e.mail'
		),
		array(
			'Figo10', 'Luis Figo', 'figo-10@e.mail'
		),
		array(
			'ArjRob', 'Arjen Robben', 'arj-rob@e.mail'
		),
		array(
			'Franbery', 'Frank Ribery', 'franbery@e.mail'
		),
		array(
			'Zlatan', 'Zlatan Ibrahimovic', 'zlatan-ibra@e.mail'
		),
		array(
			'Pilro', 'Andrea Pirlo', 'pilro@e.mail'
		)
	);
	
	if ( isset( $_POST['add-players'] ) )
	{
		$CONN = mysqli_connect( 'localhost', 'fbp', '/iZxET)I!0nSM7Ue', 'fbp' );
		
		$_output = '<h2>Players added</h2>';
		
		foreach ( $players_to_add as $entry )
		{
			$query = mysqli_query( $CONN, "CALL sp_register_player('".$entry[0]."', '".$entry[1]."', '".$entry[2]."', 'pahceuord')" );
			
			$result = $query ? mysqli_fetch_row( $query )[0] : mysqli_error( $CONN );
			
			$_output .= '<p>'.$entry[0].': '.$result.'</p>';
			
			mysqli_free_result( $query );
			
			while ( mysqli_next_result( $CONN ) ) {}
		}
		
		echo $_output;
	}
	else
	{
		$_output = '<h2>Add these players?</h2>';
		
		$_output .= '<table>';
		foreach ( $players_to_add as $entry )
		{
			$_output .=
				'<tr>'.
					'<td>'.$entry[0].'</td><td>'.$entry[1].'</td><td>'.$entry[2].'</td><td>'.'pacheuord'.'</td>'.
				'</tr>';
		}
		$_output .= '</table>';
		
		echo $_output;
		?>
		
		<form method="POST" onsubmit="return confirm('Add these players?')">
			<br />
			<input type="submit" name="add-players" value="Add players">
		</form>
		
		<?php
	}