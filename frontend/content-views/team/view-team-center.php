
<h1>Team</h1>

<h2>Applications sent</h2>

<div class="display-player-applications">
	
	<?php
	
		if ( is_array( $_team_applications ) )
		{
			foreach ( $_team_applications as $row )
			{
				?>
				
				<!-- Team -->
				<div class="display-player-applications-body">
					<a href="team-profile?id=<?= $row['id'] ?>">
						<?= $row['team_name'] ?>
					</a>
				</div>
				
				<!-- Cancel Application -->
				<div class="display-player-applications-body">
					<form method="POST" onsubmit="return confirm('Cancel application to <?= $row['team_name'] ?>?')">
						<input type="hidden" name="cancel-team-id" value="<?= $row['id'] ?>" />
						<input type="submit" value="Cancel" />
					</form>
				</div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-player-applications-body grid-span-col-2">None</div>
			
			<?php
		}
	
	?>
	
</div>

<h2>Invites</h2>

<div class="display-player-invites">

	<?php
	
		if ( is_array( $_team_invites ) )
		{
			foreach( $_team_invites as $row )
			{
				?>
				
				<!-- Team -->
				<div class="display-player-invites-body">
					<a href="team-profile?id=<?= $row['id'] ?>">
						<?= $row['team_name'] ?>
					</a>
				</div>
				
				<!-- Options -->
				<div class="display-player-invites-body">
					
					<!-- Accept Invite -->
					<form method="POST" onsubmit="return confirm('Accept invite to <?= $row['team_name'] ?>?')">
						<input type="hidden" name="accept-team-id" value="<?= $row['id'] ?>" />
						<input type="submit" value="Accept" />
					</form>
					
					<!-- Reject Invite -->
					<form method="POST" onsubmit="return confirm('Reject invite to <?= $row['team_name'] ?>?')">
						<input type="hidden" name="reject-team-id" value="<?= $row['id'] ?>" />
						<input type="submit" value="Reject" />
					</form>
					
				</div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-player-invites-body grid-span-col-2">None</div>
			
			<?php
		}
	
	?>
	
</div>
		
<?php

	// Show button leave team OR links to find/create team.
	if ( $_player_has_team )
	{
		?>
		
		<form method="POST" onsubmit="return confirm('Leave team?')">
			<br />
			<input type="submit" name="leave-team" value="Leave Team">
		</form>
		
		<?php
	}
	else
	{
		?>
		
		<h2>OR</h2>
		
		<h3><a href="search-team">Find</a> or <a href="team-create">Create</a></h3>
		
		<?php
	}

?>