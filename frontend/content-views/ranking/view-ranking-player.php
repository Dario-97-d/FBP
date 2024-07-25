
<h1>Players</h1>

<div class="display-ranking display-ranking-players">
	
	<!-- Header -->
	<div class="display-ranking-header">Rank</div>
	<div class="display-ranking-header">Username</div>
	<div class="display-ranking-header">Name</div>
	<div class="display-ranking-header">Team</div>
	<div class="display-ranking-header">RTG</div>
	
	<!-- Body -->
	
	<?php
	
		if ( is_array( $_players ) )
		{
			$r = 0;
			foreach ( $_players as $row )
			{
				$r++;
				?>
					
				<!-- Rank -->
				<div class="display-ranking-body"><?= $r ?></div>
				
				<!-- Username -->
				<div class="display-ranking-body at-username">@<?= $row['username'] ?></div>
				
				<!-- Player name -->
				<div class="display-ranking-body">
					<a href="player-profile?id=<?= $row['player_id'] ?>">
						<?= $row['player_name'] ?>
					</a>
				</div>
				
				<!-- Team -->
				<div class="display-ranking-body">
					
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
				<div class="display-ranking-body"><?= $row['rating'] ?></div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-ranking-body grid-span-col-5">None</div>
			
			<?php
		}
	
	?>
	
</div>

<?php
	// Partial View: Search Player.
	require_once $_FILEREF_partial_view_search_player;
?>