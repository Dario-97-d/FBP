
<h1>Mates</h1>

<h3><a href="mates-requests">Requests received</a></h3>
<h3><a href="mates-sent">Requests sent</a></h3>

<div class="display-mates-overview">
	
	<?php
	
		if ( is_array( $_mates ) )
		{
			?>
			
			<!-- Header -->
			<div class="display-mates-overview-header">Username</div>
			<div class="display-mates-overview-header">Player</div>
			<div class="display-mates-overview-header">Team</div>
			<div class="display-mates-overview-header">Options</div>
			
			<!-- Body -->
			
			<?php
			
				foreach( $_mates as $row )
				{
					?>
					
					<!-- Username -->
					<div class="display-mates-overview-body at-username">@<?= $row['username'] ?></div>
					
					<!-- Player name -->
					<div class="display-mates-overview-body">
						<a href="player-profile?id=<?= $row['player_id'] ?>">
							<?=  $row['player_name'] ?>
						</a>
					</div>
					
					<!-- Team -->
					<div class="display-mates-overview-body">
						
						<?php
						
							if ( $row['team_id'] )
							{
								?>
								
								<a href="team-profile?id=<?= $row['team_id'] ?>">
									<?=  $row['team_name'] ?>
								</a>
								
								<?php
							}
						
						?>
						
					</div>
					
					<!-- Remove -->
					<div class="display-mates-overview-body">
						<form method="POST" onsubmit="return confirm('Remove mate <?= $row['player_name'] ?>?')">
							<input type="hidden" name="remove-mate-id" value="<?= $row['player_id'] ?>" />
							<input type="submit" value="Remove" />
						</form>
					</div>
					
					<?php
				}
		}
		else
		{
			?>
			
			<div class="display-mates-overview-body grid-span-col-4">None</div>
			
			<?php
		}
	
	?>

</div>

<form method="POST" onsubmit="return confirm('Submit mate request to '+ document.getElementById('request-mate-username').value +'?')">
	<br />
	
	<label for="request-mate-username" hidden>Enter Username</label>
	<input type="text" id="request-mate-username" name="request-mate-username" placeholder="Username" required>
	
	<br />
	<input type="submit" value="Submit Request" />
</form>