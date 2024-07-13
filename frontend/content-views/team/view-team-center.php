
<h1>Team</h1>

<?php

	// If sql query for teams applied to was successful.
	if ( isset( $_team_applications ) )
	{
		?>
		
		<h2>Applications sent</h2>
		
		<table class="table1" cellpadding="8">
		
		<?php
		
			if ( is_array( $_team_applications ) )
			{
				foreach( $_team_applications as $row )
				{
					?>
					
					<tr>
						<td><a href="team-profile?id=<?= $row['id'] ?>"><?= $row['team_name'] ?></a></td>
						<td>
							<form method="POST" onsubmit="return confirm('Cancel application to <?= $row['team_name'] ?>?')">
								<input type="hidden" name="cancel-team-id" value="<?= $row['id'] ?>" />
								<input type="submit" value="Cancel" />
							</form>
						</td>
					</tr>
					
					<?php
				}
			}
			else
			{
				?>
				
				<tr><td>None</td></tr>
				
				<?php
			}
		
		?>
			
		</table>
		
		<?php
	}
	
	// If sql query for invites was successful.
	if ( isset( $_team_invites ) )
	{
		?>
		
		<h2>Invites</h2>
		
		<table class="table1" cellpadding="8">
		
			<?php
			
				if ( is_array( $_team_invites ) )
				{
					foreach( $_team_invites as $row )
					{
						?>
						
						<tr>
							<td><a href="team-profile?id=<?= $row['id'] ?>"><?= $row['team_name'] ?></a></td>
							<td>
								<form method="POST" onsubmit="return confirm('Accept invite to <?= $row['team_name'] ?>?')">
									<input type="hidden" name="accept-team-id" value="<?= $row['id'] ?>" />
									<input type="submit" value="Accept" />
								</form>
							</td>
							<td>
								<form method="POST" onsubmit="return confirm('Reject invite to <?= $row['team_name'] ?>?')">
									<input type="hidden" name="reject-team-id" value="<?= $row['id'] ?>" />
									<input type="submit" value="Reject" />
								</form>
							</td>
						</tr>
						
						<?php
					}
				}
				else
				{
					?>
					
					<tr><td>None</td></tr>
					
					<?php
				}
			
			?>
			
		</table>
		
		<?php
	}
	
	// Show button leave team OR links to find/create team.
	if ( $_player_has_team )
	{
		?>
		
		<form method="POST" onsubmit="return confirm('Leave team?')">
			<br /><input type="submit" name="leave-team" value="Leave Team" >
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