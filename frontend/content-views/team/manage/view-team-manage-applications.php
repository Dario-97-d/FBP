
<h1><?= $_team_name ?></h1>

<?php

	// If sql query for applicants was successful.
	if ( isset( $_team_applicants ) )
	{
		?>
		
		<h2>Applications</h2>
		<table class="table1" cellpadding="8">
		
			<?php
			
				if ( is_array( $_team_applicants ) )
				{
					foreach( $_team_applicants as $row )
					{
						?>
						
						<tr>
							<td>
								@<?= $row['username'] ?>
							</td>
							<td>
								<a href="player-profile?id=<?= $row['player_id'] ?>"><?= $row['player_name'] ?></a>
							</td>
							<td>
								<form method="POST" onsubmit="return confirm('Accept <?= $row['player_name'] ?>'s application?')">
									<input type="hidden" name="accept-player-id" value="<?= $row['player_id'] ?>" />
									<input type="submit" value="Accept" />
								</form>
							</td>
							<td>
								<form method="POST" onsubmit="return confirm('Reject <?= $row['player_name'] ?>'s application?')">
									<input type="hidden" name="reject-player-id" value="<?= $row['player_id'] ?>" />
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