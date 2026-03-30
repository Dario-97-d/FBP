<?php

	// [ username, player_name, email ]
	$players_to_add = array(
		[ 'CrisRock'    , 'Cristiano Ronaldo'     ,     'cris-rock@e.mail', [ 10, 10, 15, 10,  5 ], [ 6, 4, 6, 4, 5, 3, 6, 1, 7, 3, 4, 1 ] ],
		//[ 'CrisRock'    , 'Cristiano Ronaldo'     ,     'cris-rock@e.mail', 171 [ 33, 34, 53, 36, 15 ], [ 19, 15, 19, 14, 17, 16, 19, 1, 20, 16, 14, 1 ] ],
		[ 'LeoMessi19'  , 'Lionel Messi'          ,  'leo-messi-19@e.mail', [  5, 12, 17, 11,  5 ], [ 6, 6, 2, 3, 6, 6, 4, 1, 5, 6, 4, 1 ] ],
		//[ 'LeoMessi19 ' , 'Lionel Messi'          ,  'leo-messi-19@e.mail', 158 [  8, 37, 55, 35, 13 ], [ 18, 19, 2, 6, 19, 19, 16, 1, 16, 19, 12, 1 ] ],
		[ 'RoniGau'     , 'Ronaldinho Gaucho'     ,      'roni-gau@e.mail', [  6, 10, 18, 11,  5 ], [ 5, 5, 2, 4, 7, 5, 5, 1, 5, 6, 4, 1 ] ],
		//[ 'RoniGau'     , 'Ronaldinho Gaucho'     ,      'roni-gau@e.mail', 165 [ 24, 33, 54, 31, 13 ], [ 17, 16, 11, 13, 20, 17, 16, 1, 15, 16, 12, 1 ] ],
		[ 'Zinene'      , 'Zinedine Zidane'       ,        'zinene@e.mail', [  6,  5, 21, 12,  6 ], [ 2, 3, 3, 3, 6, 6, 6, 3, 6, 6, 4, 2 ] ],
		//[ 'Zinene'      , 'Zinedine Zidane'       ,        'zinene@e.mail', 164 [ 27, 19, 61, 33, 24 ], [ 7, 12, 14, 13, 18, 18, 18, 7, 16, 17, 16, 8 ] ],
		[ 'IlFeno'      , 'Ronaldo Nazaario'      ,       'il-feno@e.mail', [  8, 10, 18,  9,  5 ], [ 5, 5, 4, 4, 7, 3, 7, 1, 6, 3, 4, 1 ] ],
		//[ 'IlFeno'      , 'Ronaldo Nazaario'      ,       'il-feno@e.mail', 169 [ 26, 33, 55, 31, 14 ], [ 17, 16, 12, 14, 20, 15, 19, 1, 18, 13, 13, 1 ] ],
		[ 'Figo10'      , 'Luis Figo'             ,       'figo-10@e.mail', [  6,  6, 21, 11,  6 ], [ 3, 3, 3, 3, 6, 6, 6, 3, 6, 5, 4, 2 ] ],
		[ 'XaviHer'     , 'Xavi Hernandez'        ,      'xavi-her@e.mail', [  5,  6, 18, 12,  9 ], [ 2, 4, 2, 3, 5, 7, 3, 3, 5, 7, 6, 3 ] ],
		[ 'AndresIni'   , 'Andres Iniesta'        ,    'andres-ini@e.mail', [  5, 10, 18, 10,  7 ], [ 4, 6, 2, 3, 6, 6, 4, 2, 5, 5, 6, 1 ] ],
		[ 'Zlatan'      , 'Zlatan Ibrahimovic'    ,   'zlatan-ibra@e.mail', [ 12,  8, 16,  9,  5 ], [ 4, 4, 6, 6, 5, 4, 6, 1, 6, 3, 4, 1 ] ],
		[ 'Pilro'       , 'Andrea Pirlo'          ,         'pilro@e.mail', [  5,  6, 18, 11, 10 ], [ 2, 4, 2, 3, 4, 6, 4, 4, 4, 7, 6, 4 ] ],
		[ 'Kepler'      , 'Pepe Laveran'          ,        'kepler@e.mail', [ 11,  8, 12,  6, 13 ], [ 4, 4, 6, 5, 2, 3, 1, 6, 2, 4, 7, 6 ] ],
		[ 'SR4'         , 'Sergio Ramos'          ,         's-r-4@e.mail', [ 10,  7, 14,  7, 12 ], [ 3, 4, 6, 4, 3, 3, 2, 6, 3, 4, 6, 6 ] ],
		[ 'LahmSchaft'  , 'Philipp Lahm'          ,   'lahm-schaft@e.mail', [  5,  7, 16, 10, 12 ], [ 3, 4, 2, 3, 3, 5, 3, 5, 4, 6, 7, 5 ] ],
		[ 'Kimicher'    , 'Joshua Kimmich'        ,      'kimicher@e.mail', [  6,  8, 15, 10, 11 ], [ 4, 4, 3, 3, 3, 5, 3, 4, 5, 5, 6, 5 ] ],
		[ 'ArjRob'      , 'Arjen Robben'          ,       'arj-rob@e.mail', [  7, 12, 17,  9,  5 ], [ 6, 6, 3, 4, 7, 4, 5, 1, 6, 3, 4, 1 ] ],
		[ 'Franbery'    , 'Frank Ribery'          ,      'franbery@e.mail', [  6, 12, 17,  9,  6 ], [ 6, 6, 2, 4, 7, 5, 4, 1, 5, 4, 4, 1 ] ],
		[ 'EdenHaz'     , 'Eden Hazard'           ,      'eden-haz@e.mail', [  5, 12, 18, 10,  5 ], [ 6, 6, 2, 3, 7, 6, 4, 1, 5, 5, 3, 2 ] ],
		[ 'FrankLamp'   , 'Frank Lampard'         ,    'frank-lamp@e.mail', [  8,  6, 18, 10,  8 ], [ 3, 3, 3, 5, 4, 5, 6, 3, 5, 5, 5, 3 ] ],
		[ 'DidiDrogba'  , 'Didier Drogba'         ,   'didi-drogba@e.mail', [ 13,  8, 15,  9,  5 ], [ 5, 3, 6, 7, 4, 3, 7, 1, 6, 3, 3, 2 ] ],
		[ 'JohnTerry'   , 'John Terry'            ,    'john-terry@e.mail', [ 13,  5, 14,  5, 13 ], [ 2, 3, 7, 6, 2, 4, 1, 7, 2, 3, 6, 7 ] ],
		[ 'RyanGiggs'   , 'Ryan Giggs'            ,    'ryan-giggs@e.mail', [  6,  8, 19, 11,  6 ], [ 4, 4, 2, 4, 6, 6, 4, 3, 6, 5, 4, 2 ] ],
		[ 'PaulScholes' , 'Paul Scholes'          ,  'paul-scholes@e.mail', [  5,  9, 19, 10,  7 ], [ 3, 6, 2, 3, 5, 7, 5, 2, 4, 6, 5, 2 ] ],
		[ 'DavidBecky'  , 'David Beckham'         ,   'david-becky@e.mail', [  6, 10, 19, 10,  5 ], [ 5, 5, 2, 4, 5, 7, 6, 1, 3, 7, 3, 2 ] ],
		[ 'GaryNevy'    , 'Gary Neville'          ,     'gary-nevy@e.mail', [  6, 10, 16,  6, 12 ], [ 5, 5, 2, 4, 3, 4, 2, 7, 3, 3, 6, 6 ] ],
		[ 'RioFerdino'  , 'Rio Ferdinand'         ,    'rio-ferdio@e.mail', [ 13,  5, 13,  6, 13 ], [ 3, 2, 6, 7, 2, 3, 1, 7, 3, 3, 6, 7 ] ],
		[ 'Nemanjidic'  , 'Nemanja Vidic'         ,    'nemanjidic@e.mail', [ 12,  5, 13,  6, 14 ], [ 3, 2, 6, 6, 2, 2, 1, 8, 3, 3, 7, 7 ] ],
		[ 'Marcelo12'   , 'Marcelo Vieira'        ,    'marcelo-12@e.mail', [  5, 10, 19,  8,  8 ], [ 5, 5, 2, 3, 7, 6, 3, 3, 4, 4, 4, 4 ] ],
		[ 'RobyCharlie' , 'Roberto Carlos'        ,  'roby-charlie@e.mail', [  8, 12, 18,  6,  6 ], [ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 ] ],
		[ 'RaulGonza'   , 'Raul Gonzalez'         ,    'raul-gonza@e.mail', [  6,  8, 19, 12,  5 ], [ 4, 4, 3, 3, 5, 5, 8, 1, 8, 4, 3, 2 ] ],
		[ 'SergioBus'   , 'Sergio Busquets'       ,    'sergio-bus@e.mail', [  5,  5, 17, 13, 10 ], [ 2, 3, 3, 2, 7, 6, 1, 3, 6, 7, 6, 4 ] ],
		[ 'NeymarJr'    , 'Neymar Junior'         ,     'neymar-jr@e.mail', [  5, 13, 18,  9,  5 ], [ 6, 7, 3, 2, 7, 5, 5, 1, 5, 4, 4, 1 ] ],
		[ 'DecoMagico'  , 'Deco Magico'           ,   'deco-magico@e.mail', [  5,  6, 20, 12,  7 ], [ 2, 4, 2, 3, 6, 7, 4, 3, 5, 7, 5, 2 ] ],
		[ 'CarlitoPuyol', 'Carles Puyol'          , 'carlito-puyol@e.mail', [  9,  6, 15,  7, 13 ], [ 3, 3, 4, 5, 3, 3, 2, 7, 3, 4, 6, 7 ] ],
		[ 'DavidLuiz'   , 'David Luiz'            ,    'david-luiz@e.mail', [ 10,  9, 16,  6,  9 ], [ 5, 4, 5, 5, 4, 3, 3, 6, 3, 3, 4, 5 ] ],
		[ 'AshleyCole'  , 'Ashley Cole'           ,   'ashley-cole@e.mail', [ 11,  6, 14,  8, 11 ], [ 6, 5, 2, 4, 3, 3, 2, 6, 4, 4, 5, 6 ] ],
		[ 'ThomasMuller', 'Thomas Muller'         , 'thomas-muller@e.mail', [  7,  7, 17, 13,  6 ], [ 3, 4, 3, 4, 4, 5, 6, 2, 7, 6, 4, 2 ] ],
		[ 'SwineTigris' , 'Bastian Schweinsteiger',  'swine-tigris@e.mail', [  7,  6, 18, 11,  8 ], [ 3, 3, 3, 4, 4, 6, 6, 2, 5, 6, 5, 3 ] ],
		[ 'RobbieLewa'  , 'Robert Lewandowski'    ,   'robbie-lewa@e.mail', [ 10,  7, 16, 11,  6 ], [ 4, 3, 6, 4, 4, 4, 7, 1, 7, 4, 4, 2 ] ],
		// [ '', '', '@e.mail', [ 5, 5, 5, 5, 5 ], [ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 ] ],
		// [ '', '', '@e.mail', [ 5, 5, 5, 5, 5 ], [ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 ] ],
	);
	
	if ( isset( $_POST['add-players'] ) )
	{
		$CONN = mysqli_connect( 'localhost', 'fbp', '/iZxET)I!0nSM7Ue', 'fbp' );
		
		$_output = '<h2>Players added</h2>';
		
		$i = 0;
		foreach ( $players_to_add as $entry )
		{
			$i++;
			
			$create = mysqli_query( $CONN, "CALL sp_register_player('".$entry[0]."', '".$entry[1]."', '".$entry[2]."', 'pahceuord')" );
			
			$result = $create ? mysqli_fetch_row( $create )[0] : mysqli_error( $CONN );
			
			$_output .= '<p>'.$entry[0].': '.$result.'</p>';
			
			mysqli_free_result( $create );
			
			while ( mysqli_next_result( $CONN ) ) {}
			
			if ( $result !== 'success' ) break;
			
			$set_attributes = mysqli_query(
				$CONN,
					'UPDATE football_players   f
					JOIN    generic_attributes g ON g.player_id = f.id
					JOIN    playing_attributes p ON p.player_id = f.id
					SET
						rating = 50,
						strength  = '.$entry[3][0].',
						movement  = '.$entry[3][1].',
						skill     = '.$entry[3][2].',
						attacking = '.$entry[3][3].',
						defending = '.$entry[3][4].',
						available_points = 0,
						speed     = '.$entry[4][0] .',
						agility   = '.$entry[4][1] .',
						airplay   = '.$entry[4][2] .',
						power     = '.$entry[4][3] .',
						dribble   = '.$entry[4][4] .',
						pass      = '.$entry[4][5] .',
						shoot     = '.$entry[4][6] .',
						tackle    = '.$entry[4][7] .',
						position  = '.$entry[4][8] .',
						vision    = '.$entry[4][9] .',
						prevision = '.$entry[4][10].',
						marking   = '.$entry[4][11].
					' WHERE f.id = '.$i );
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