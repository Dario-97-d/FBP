
<h1><?= $_profile['team_name'] ?></h1>

<h2>Class <?= $_profile['team_class'] ?> | <?= $_profile['rating'] ?> &empty;</h2>

<div class="display-team-profile-members">
	
	<div class="display-team-profile-members-header">#</div>
	<div class="display-team-profile-members-header">Username</div>
	<div class="display-team-profile-members-header">Players</div>
	<div class="display-team-profile-members-header">RTG</div>
	
	<?php
	
		$r = 0;
		foreach ( $_team_members as $row )
		{
			$r++;
			?>
			
			<!-- # -->
			<div class="display-team-profile-members-body"><?= $r ?></div>
			
			<!-- Username -->
			<div class="display-team-profile-members-body at-username">@<?= $row['username'] ?></div>
			
			<!-- Player name -->
			<div class="display-team-profile-members-body">
				<a href="player-profile?id=<?= $row['player_id'] ?>">
					<?= $row['player_name'] ?>
				</a>
			</div>
			
			<!-- Rating -->
			<div class="display-team-profile-members-body"><?= $row['player_rating'] ?></div>
			
			<?php
		}
	
	?>
	
</div>

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
				
				<form action="team-center" method="POST" onsubmit="return confirm('Apply to <?= $_profile['team_name'] ?>?')">
					<input type="hidden" name="apply-team-id" value="<?= $_team_id ?>" />
					<input type="submit" value="Apply to team" />
				</form>
				
				<?php
				break;
			
			case 'has team': break;
			
			case 'has application':
				?>
				
				<form action="team-center" method="POST" onsubmit="return confirm('Cancel application to <?= $_profile['team_name'] ?>?')">
					<input type="hidden" name="cancel-team-id" value="<?= $_team_id ?>" />
					<input type="submit" value="Cancel application" />
				</form>
				
				<?php
				break;
			
			case 'has invite':
				?>
				
				<form action="team-center" method="POST" onsubmit="return confirm('Accept invite from <?= $_profile['team_name'] ?>?')">
					<input type="hidden" name="accept-team-id" value="<?= $_team_id ?>" />
					<input type="submit" value="Accept Invite" />
				</form>
				
				<form action="team-center" method="POST" onsubmit="return confirm('Reject invite from <?= $_profile['team_name'] ?>?')">
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