
<h1>Mates</h1>

<h2>Requests Received</h2>

<table class="table1" cellpadding="8" cellspacing="0">
	
	<?php
	
		if ( is_array( $_requests_received ) )
		{
			foreach ( $_requests_received as $row )
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
					
					<!-- Accept Request -->
					<td>
						<form method="POST" onsubmit="return confirm('Accept <?= $row['player_name'] ?>'s request?')">
							<input type="hidden" name="accept-mate-id" value="<?= $row['player_id'] ?>" />
							<input type="submit" value="Accept" />
						</form>
					</td>
					
					<!-- Decline Request -->
					<td>
						<form method="POST" onsubmit="return confirm('Decline <?= $row['player_name'] ?>'s request?')">
							<input type="hidden" name="decline-mate-id" value="<?= $row['player_id'] ?>" />
							<input type="submit" value="Decline" />
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