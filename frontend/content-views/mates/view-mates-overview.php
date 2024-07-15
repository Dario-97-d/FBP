
<h1>Mates</h1>

<h3><a href="mates-requests">Requests received</a></h3>
<h3><a href="mates-sent">Requests sent</a></h3>

<table class="table2" cellpadding="8" cellspacing="0">
	
<?php

	if ( is_array( $_mates ) )
	{
		?>
		
		<tr>
			<th>Username</th>
			<th>Player name</th>
			<th>Team</th>
			<th>Options</th>
		</tr>
		
		<?php
		foreach ( $_mates as $row )
		{
			?>
			
			<tr>
			
				<!-- Username -->
				<td align="left" class="at-username">
					@<?= $row['username'] ?>
				</td>
				
				<!-- Player -->
				<td>
					<a href="player-profile?id=<?= $row['player_id'] ?>"><?= $row['player_name'] ?></a>
				</td>
				
				<!-- Team -->
				<td>
					
					<?php
					
						if ( $row['team_id'] )
						{
							?>
							
							<a href="team-profile?id=<?= $row['team_id'] ?>"><?= $row['team_name'] ?></a>
							
							<?php
						}
					
					?>
					
				</td>
				
				<!-- Options -->
				<td>
					<form method="POST" onsubmit="return confirm('Remove mate <?= $row['player_name'] ?>?')">
						<input type="hidden" name="remove-mate-id" value="<?= $row['player_id'] ?>" />
						<input type="submit" value="Remove" />
					</form>
				</td>
			
			</tr>
			
			<?php
		}
	}
	else
	{
		?>
		
		<tr><td colspan="4">None</td></tr>
		
		<?php

	}

?>
	
</table>

<br />

<form method="POST" onsubmit="return confirm('Submit mate request?')">
	
	<label for="request-mate-username" hidden>Enter Username</label>
	<input type="text" id="request-mate-username" name="request-mate-username" placeholder="Username" />
	
	<br />
	
	<input type="submit" value="Submit Request" />
</form>