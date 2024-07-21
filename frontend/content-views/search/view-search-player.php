
<h2>Search Player</h2>

<?php
	// Partial View: Search Player.
	require_once $_FILEREF_partial_view_search_player;
?>

<br />

<table class="table1" cellpadding="8" cellspacing="0">
	
	<?php
	
		if ( is_array( $_players_found ) )
		{
			?>
			
			<tr>
				<th>Username</th>
				<th>Player name</th>
				<th>Rating</th>
				<th>Team</th>
			</tr>
			
			<?php
			foreach ( $_players_found as $row )
			{
				?>
				
				<tr>
				
					<!-- Username -->
					<td align="left" class="at-username">
						@<?= $row['username'] ?>
					</td>
					
					<!-- Player -->
					<td>
						<a href="player-profile?id=<?= $row['player_id'] ?>"><?= $row['player_name'] ?></a>
					</td>
					
					<!-- Rating -->
					<td>
						<?= $row['rating'] ?>
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
				
				</tr>
				
				<?php
			}
		}
		else
		{
			?>
			
			<tr><td>No results.</td></tr>
			
			<?php
		}
	
	?>
	
</table>