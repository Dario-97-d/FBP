
<h1>Mates</h1>

<h2>Requests Sent</h2>

<table class="table1" cellpadding="8" cellspacing="0">
	
	<?php
	
		if ( is_array( $_requests_sent ) )
		{
			foreach ( $_requests_sent as $row )
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
						<form method="POST" onsubmit="return confirm('Cancel request to <?= $row['player_name'] ?>?')">
							<input type="hidden" name="cancel-mate-id" value="<?= $row['player_id'] ?>" />
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