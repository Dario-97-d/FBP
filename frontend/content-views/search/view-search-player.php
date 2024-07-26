
<h2>Search Player</h2>

<?php
	// Partial View: Search Player.
	require_once $_FILEREF_partial_view_search_player;
?>

<br />

<div class="display-search-results display-search-results-players">
	
	<?php
	
		if ( is_array( $_players_found ) )
		{
			?>
			
			<div class="display-search-results-header">Username</div>
			<div class="display-search-results-header">Player name</div>
			<div class="display-search-results-header">Team</div>
			<div class="display-search-results-header">RTG</div>
			
			<?php
			foreach ( $_players_found as $row )
			{
				?>
				
				<!-- Username -->
				<div class="display-search-results-body at-username">@<?= $row['username'] ?></div>
				
				<!-- Player -->
				<div class="display-search-results-body">
					<a href="player-profile?id=<?= $row['player_id'] ?>">
						<?= $row['player_name'] ?>
					</a>
				</div>
				
				<!-- Team -->
				<div class="display-search-results-body">
					
					<?php
					
						if ( $row['team_id'] )
						{
							?>
							
							<a href="team-profile?id=<?= $row['team_id'] ?>">
								<?= $row['team_name'] ?>
							</a>
							
							<?php
						}
					
					?>
					
				</div>
				
				<!-- Rating -->
				<div class="display-search-results-body"><?= $row['rating'] ?></div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-search-results-body grid-span-col-4">No results.</div>
			
			<?php
		}
	
	?>
	
</div>