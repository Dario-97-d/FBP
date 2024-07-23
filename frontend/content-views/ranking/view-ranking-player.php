
<h1>Players</h1>

<table class="table2" cellpadding="8" cellspacing="0">
	<tr>
		<th>Rank</th>
		<th>Username</th>
		<th>Name</th>
		<th>Team</td>
		<th>Rating</th>
	</tr>
	
	<?php
	
		if ( is_array( $_players ) )
		{
			$r = 0;
			foreach ( $_players as $row )
			{
				$r++;
				?>
				
				<tr>
				
					<!-- Rank # -->
					<td>
						<?= $r ?>
					</td>
					
					<!-- Username -->
					<td  align="left" class="at-username">
						@<?= $row['username'] ?>
					</td>
					
					<!-- Player -->
					<td>
						<a href="player-profile?id=<?= $row['player_id'] ?>"><?= $row['player_name'] ?></a>
					</td>
					
					<!-- Team -->
					<td>
						
						<?php
						
							if ( $row['team_id'] )
							{
								?>
								
								<a href="team-profile?id=<?= $row['team_id'] ?>"><?= $row['team_name'] ?></a>
								
								<?php
							}
						
						?>
						
					</td>
					
					<!-- Rating -->
					<td>
						<?= $row['rating'] ?>
					</td>
				
				</tr>
					
				<?php
			}
		}
		else
		{
			?>
			
			<tr><td colspan="5">None</td></tr>
			
			<?php
		}
	
	?>
	
</table>

<?php
	// Partial View: Search Player.
	require_once $_FILEREF_partial_view_search_player;
?>