
<h1>Mates</h1>

<h2>Requests Received</h2>

<div class="display-mates-requests display-mates-requests-received">

	<?php
	
		if ( is_array( $_requests_received ) )
		{
			foreach ( $_requests_received as $row )
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
				
				<!-- Options -->
				<div class="display-mates-requests-body">
					
					<!-- Accept Request -->
					<form method="POST" onsubmit="return confirm('Accept request from <?= $row['player_name'] ?>?')">
						<input type="hidden" name="accept-mate-id" value="<?= $row['player_id'] ?>" />
						<input type="submit" value="Accept" />
					</form>
				
					<!-- Decline Request -->
					<form method="POST" onsubmit="return confirm('Decline request from <?= $row['player_name'] ?>?')">
						<input type="hidden" name="decline-mate-id" value="<?= $row['player_id'] ?>" />
						<input type="submit" value="Decline" />
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