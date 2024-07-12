
<h1><?= $_team['team_name'] ?></h1>

<h2>Class <?= $_team['team_class'] ?> | <?= $_team['rating'] ?> &empty;</h2>

<!-- Display all members -->
<table class="table1" cellpadding="8">
	<tr>
		<th>Staff</th>
		<th>Username</th>
		<th>Player</th>
		<th>Rating</th>
	</tr>
	
	<?php
	
		// Count rows for later display.
		$r = 0;
		
		// Display team members.
		foreach ( $_team_members as $row )
		{
			$r++;
			?>
			
			<tr>
			
				<!-- Staff role -->
				<td>
					<?= $row['staff_role'] ?>
				</td>
				
				<!-- Username -->
				<td  align="left" class="at-username">
					@<?= $row['username'] ?>
				</td>
				
				<!-- Player -->
				<td>
					<a href="player-profile?id=<?= $row['player_id'] ?>"><?= $row['player_name'] ?></a>
				</td>
				
				<!-- Rating -->
				<td>
					<?= $row['player_rating'] ?>
				</td>
			
			</tr>
			
			<?php
		}
		
		// Display additional rows, up to 5 in total.
		while ( $r < 5 )
		{
			$r++;
			?>
			
			<tr><td><?= $r ?></td><td>-</td><td>-</td></tr>
			
			<?php
		}
	
	?>
	
</table>

<h3><?= $_team['members'] ?> members</h3>

<?php

	if ( $_show_link_management )
	{
		?>
		
		<h2><a href="team-manage">Management</a></h2>
		
		<?php
	}

?>

<h2><a href="play-5">Play 5v5</a></h2>
<h2><a href="team-center">Team center</a></h2>