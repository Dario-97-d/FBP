
<h1><?= $_team_name ?></h1>

<h2>Applications</h2>

<div class="display-team-applications">
	
	<?php
	
		if ( is_array( $_team_applicants ) )
		{
			foreach( $_team_applicants as $row )
			{
				?>
				
				<!-- Username -->
				<div class="display-team-applications-body at-username">@<?= $row['username'] ?></div>
				
				<!-- Player name -->
				<div class="display-team-applications-body">
					<a href="player-profile?id=<?= $row['player_id'] ?>">
						<?= $row['player_name'] ?>
					</a>
				</div>
				
				<!-- Options -->
				<div class="display-team-applications-body">
					
					<!-- Accept Application -->
					<form method="POST" onsubmit="return confirm('Accept application from <?= $row['player_name'] ?>?')">
						<input type="hidden" name="accept-player-id" value="<?= $row['player_id'] ?>" />
						<input type="submit" value="Accept" />
					</form>
					
					<!-- Reject Application -->
					<form method="POST" onsubmit="return confirm('Reject application from <?= $row['player_name'] ?>?')">
							<input type="hidden" name="reject-player-id" value="<?= $row['player_id'] ?>" />
							<input type="submit" value="Reject" />
						</form>
					
				</div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-team-applications-body grid-span-col-3">None</div>
			
			<?php
		}
	
	?>
	
</div>