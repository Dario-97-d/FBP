
<h1><?= $_team_info['team_name'] ?></h1>

<h2>Class <?= $_team_info['team_class'] ?> | <?= $_team_info['rating'] ?> &empty;</h2>

<table class="table2" style="width:512px;" cellpadding="8" cellspacing="0">
	<tr>
		<th>#</th>
		<th>Username</th>
		<th>Players</th>
		<th>Rating</th>
	</tr>
	
	<?php
	
		$r = 0;
		foreach ( $_team_members as $row )
		{
			$r++;
			?>
			
			<tr>
				
				<!-- # -->
				<td><?= $r ?></td>
				
				<!-- Username -->
				<td class="at-username">@<?= $row['username'] ?></td>
				
				<!-- Player -->
				<td><a href="player-profile?id=<?= $row['player_id'] ?>"><?= $row['player_name'] ?></a></td>
				
				<!-- Rating -->
				<td><?= $row['player_rating'] ?></td>
			
			</tr>
			
			<?php
		}
	
	?>
	
</table>

<?php

	if ( $_IS_LOGGED_IN )
	{
		?>
		
		<h3><a href="play-5-arrange?team-id=<?= $_team_id ?>">Play 5v5</a></h3>
		
		<?php
		switch ( $_player_team_status )
		{
			case 'none':
				?>
				
				<form action="team-center" method="POST" onsubmit="return confirm('Apply to <?= $_team_info['team_name'] ?>?')">
					<input type="hidden" name="apply-team-id" value="<?= $_team_id ?>" />
					<input type="submit" value="Apply to team" />
				</form>
				
				<?php
				break;
			
			case 'has team': break;
			
			case 'has application':
				?>
				
				<form action="team-center" method="POST" onsubmit="return confirm('Cancel application to <?= $_team_info['team_name'] ?>?')">
					<input type="hidden" name="cancel-team-id" value="<?= $_team_id ?>" />
					<input type="submit" value="Cancel application" />
				</form>
				
				<?php
				break;
			
			case 'has invite':
				?>
				
				<form action="team-center" method="POST" onsubmit="return confirm('Accept invite from <?= $_team_info['team_name'] ?>?')">
					<input type="hidden" name="accept-team-id" value="<?= $_team_id ?>" />
					<input type="submit" value="Accept Invite" />
				</form>
				
				<form action="team-center" method="POST" onsubmit="return confirm('Reject invite from <?= $_team_info['team_name'] ?>?')">
					<input type="hidden" name="reject-team-id" value="<?= $_team_id ?>" />
					<input type="submit" value="Reject Invite" />
				</form>
				
				<?php
				break;
			
			case 'has 5 applications':
				?>
				
				The player already has 5 <a href="team-center">applications</a>
				
				<?php
		}
	}

?>