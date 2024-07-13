
<h1><?= $_team_name ?></h1>

<h2>Invite players</h2>

<form action="search-player" method="GET">
	<br />
	<input type="text" name="name" />
	<br />
	<input type="submit" value="Search Player">
</form>

<?php

	// If sql query for applicants was successful.
	if ( isset( $_invitees ) )
	{
		?>
		
		<h2>Invitations</h2>
		<table class="table1" cellpadding="8">
		
			<?php
			
				if ( is_array( $_invitees ) )
				{
					foreach( $_invitees as $row )
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
								<form method="POST" onsubmit="return confirm('Withdraw invite to <?= $row['player_name'] ?>?')">
									<input type="hidden" name="withdraw-player-id" value="<?= $row['player_id'] ?>" />
									<input type="submit" value="Withdraw" />
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