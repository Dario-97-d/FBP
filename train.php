<?php require_once 'backend/backstart.php'; ?>

<?php

	// Train. $_POST['att'] == 'Train'
	if ( $att = array_search( 'Train', $_POST ) )
	{
		if ( in_array( $att, array('strength', 'movement', 'skill', 'attacking', 'defending') ) )
		{
			// Check training points.
			$new_training_points -= ( $att == 'skill' ? 2 : 1 );
			
			if ( $new_training_points < 0 )
			{
				DIALOG_add_fail('Not enough Training Points');
			}
			else
			{
				// Increment value of att.
				$$att += 1;
				
				// Update player's attributes.
				SQL_prep_stmt_one( 'UPDATE generic_attributes SET ? = ? + 1, training_points = ? WHERE player_id = ?', array( $att, $att, $training_points, $_player_id ) );
				
				// Check for rating change.
				if ( $rating < ceil( ( $strength + $movement + $skill + $attacking + $defending ) / 5 ) )
				{
					// Update player's rating.
					SQL_prep_stmt_one( 'UPDATE football_players SET rating = rating + 1 WHERE player_id = ?', array( $_player_id ) );
					
					// Update team's rating.
					SQL_prep_stmt_one( 'UPDATE teams SET rating = rating + 1 WHERE id = ?', array() );
				}
			}
			
		}
	}

?>

<!-- Render -->

<h1><a href="train">Train</a></h1>

<table class="table2" cellpadding="8">
	<tr><th colspan="5">RTG: <?= $rating ?></th></tr>
	<tr><td>STR</td><td>MOV</td><td>SKL</td><td>ATK</td><td>DFS</td></tr>
	<?='<tr><td>' . $strength . '</td><td>' . $movement . '</td><td>' . $skill . '</td><td>' . $attacking . '</td><td>' . $defending . '</td></tr>' ?>
	<tr><form action="train" method="POST" onsubmit="return confirm('?')">
		<td><input type="submit" name="str" value="Train"></td>
		<td><input type="submit" name="mov" value="Train"></td>
		<td><input type="submit" name="skl" value="Train"></td>
		<td><input type="submit" name="atk" value="Train"></td>
		<td><input type="submit" name="dfs" value="Train"></td>
	</form></tr>
	<tr><th colspan="5"><?= $training_points ?></th></tr>
</table>

<br />
<hr color="purple" style="width:394px">
<br />

<table class="table1">
	<tr><th style="width:170px">Physical</th><th style="width:170px">Technical</th><th style="width:170px">Tactical</th></tr>
	<form action="train" method="POST">
		<tr>
			<td><?= ( $movement > $pace + $agility ? '<a href="train?t=speed" name="speed">Speed</a>: ' . $pace . ' (' . ( $movement - ( $pace + $agility ) ) . ')' : 'Speed: ' . $pace ) ?></td>
			<td><?= ( $skill > $dribbling + $passing + $shooting + $tackling ? '<a href="train?t=dribb" name="dribb">Dribble</a>: ' . $dribbling . ' (' . ( $skill - ( $dribbling + $passing + $shooting + $tackling ) ) . ')' : 'Dribble: ' . $dribbling ) ?></td>
			<td><?= ( $attacking > $opportunity + $vision ? '<a href="train?t=posit" name="posit">Position</a>: ' . $opportunity . ' (' . ( $attacking - ( $opportunity + $vision ) ) . ')' : 'Position: ' . $opportunity ) ?></td>
		</tr>
		<tr>
			<td><?= ( $movement > $pace + $agility ? '<a href="train?t=agili" name="agili">Agility</a>: ' . $agility . ' (' . ( $movement - ( $pace + $agility ) ) . ')' : 'Agility: ' . $agility ) ?></td>
			<td><?= ( $skill > $dribbling + $passing + $shooting + $tackling ? '<a href="train?t=passe" name="passe">Pass</a>: ' . $passing . ' (' . ( $skill - ( $dribbling + $passing + $shooting + $tackling ) ) . ')' : 'Pass: ' . $passing ) ?></td>
			<td><?= ( $attacking > $opportunity + $vision ? '<a href="train?t=visio" name="visio">Vision</a>: ' . $vision . ' (' . ( $attacking - ( $opportunity + $vision ) ) . ')' : 'Vision: ' . $vision ) ?></td>
		</tr>
		<tr>
			<td><?= ( $strength > $air_play + $duels ? '<a href="train?t=airpl" name="airpl">Airplay</a>: ' . $air_play . ' (' . ( $strength - ( $air_play + $duels ) ) . ')' : 'Airplay: ' . $air_play ) ?></td>
			<td><?= ( $skill > $dribbling + $passing + $shooting + $tackling ? '<a href="train?t=shots" name="shots">Shot</a>: ' . $shooting . ' (' . ( $skill - ( $dribbling + $passing + $shooting + $tackling ) ) . ')' : 'Shot: ' . $shooting ) ?></td>
			<td><?= ( $defending > $marking + $positioning ? '<a href="train?t=marki" name="marki">Marking</a>: ' . $marking . ' (' . ( $defending - ( $marking + $positioning ) ) . ')' : 'Marking: ' . $marking ) ?></td>
		</tr>
		<tr>
			<td><?= ( $strength > $air_play + $duels ? '<a href="train?t=energ" name="energ">Energy</a>: ' . $duels . ' (' . ( $strength - ( $air_play + $duels ) ) . ')' : 'Energy: ' . $duels ) ?></td>
			<td><?= ( $skill > $dribbling + $passing + $shooting + $tackling ? '<a href="train?t=tackl" name="tackl">Tackle</a>: ' . $tackling . ' (' . ( $skill - ( $dribbling + $passing + $shooting + $tackling ) ) . ')' : 'Tackle: ' . $tackling ) ?></td>
			<td><?= ( $defending > $marking + $positioning ? '<a href="train?t=previ" name="previ">Prevision</a>: ' . $positioning . ' (' . ( $defending - ( $marking + $positioning ) ) . ')' : 'Prevision: ' . $positioning ) ?></td>
		</tr>
	</form>
</table>