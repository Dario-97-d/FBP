
<h1>Mates</h1>

<h2>Requests Sent</h2>

<div class="display-mates-requests display-mates-requests-sent">

	<?php
	
		if ( is_array( $_requests_sent ) )
		{
			foreach ( $_requests_sent as $row )
			{
				?>
				
				<!-- Username -->
				<div class="display-mates-requests-body at-username">@<?= $row['username'] ?></div>
				
				<!-- Player name -->
				<div class="display-mates-requests-body">
					<a href="player-profile?id=<?= $row['player_id'] ?>">
						<?= $row['player_name'] ?>
					</a>
				</div>
				
				<!-- Team -->
				<div class="display-mates-requests-body">
					
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
				
				<!-- Withdraw -->
				<div class="display-mates-requests-body">
					<form method="POST" onsubmit="return confirm('Cancel request to <?= $row['player_name'] ?>?')">
						<input type="hidden" name="cancel-mate-id" value="<?= $row['player_id'] ?>" />
						<input type="submit" value="Withdraw" />
					</form>
				</div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-mates-requests-body grid-span-col-4">None</div>
			
			<?php
		}
	
	?>

</div>