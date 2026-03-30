
<h1><?= $_profile['player_name'] ?></h1>

<h4>@<?= $_profile['username'] ?></h4>

<span>Plays for <?= $_profile['team_name'] ?></span>

<?php
	// Partial View: Generic Attributes.
	require_once $_FILEREF_partial_view_generic_attributes;
?>

<?php

	// Display certain controls if user is logged in and is not seeing the own profile.
	if ( $_show_controls )
	{
		?>
		
		<!-- Link to Arrange 3-a-side -->
		<h3><a href="play-3-arrange?partner-id=<?= $_profile_id ?>">Play-3</a></h3>
		
		<?php
		
			if ( $_show_button_play5_selection )
			{
				?>
				
				<form action="play-5-arrange" method="POST">
					<input type="hidden" name="selected-ids[]" value="<?= $_profile_id ?>">
					<input type="submit" name="select-players" value="Select for Play-5">
				</form>
				
				<?php
			}
		
		?>
		
		<!-- Link to Write message -->
		<h3><a href="mail-send?to-username=<?= $_profile['username'] ?>">Message</a></h3>
		
		<?php
		switch ( $_mate_status )
		{
			case 'none':
				?>
				
				<!-- Request Mate -->
				<form action="mates-overview" method="POST" onsubmit="return confirm('Send mate request to <?= $_profile['username'] ?>?')">
					<input type="hidden" name="request-mate-username" value="<?= $_profile['username'] ?>" />
					<input type="submit" value="Request Mate" />
				</form>
				
				<?php
				break;
			
			case 'mates':
				?>
				
				<!-- Link to Mates -->
				<a href="mates-overview">Mate</a>
				
				<?php
				break;
			
			case 'request received':
				?>
				
				<!-- Link to Mates requests received -->
				<a href="mates-requests">Mate request received</a>
				
				<?php
				break;
			
			case 'request sent':
				?>
				
				<!-- Link to Mates requests sent -->
				<a href="mates-sent">Mate request sent</a>
				
				<?php
				break;
		}
		
		
		switch ( $_invite_status )
		{
			case 'invited':
				?>
				
				<p>This player has an <a href="team-manage-invites">invite</a> from the team.</p>
				
				<?php
				break;
			
			case 'can_invite':
				?>
				
				<!-- Invite player to team -->
				<form action="team-manage-invites" method="POST" onsubmit="return confirm('Invite <?= $_profile['player_name'] ?> to team?')">
					<input type="hidden" name="invite-player-id" value="<?= $_profile_id ?>" />
					<input type="submit" value="Invite to Team" />
				</form>
				
				<?php
				break;
		}
	}

?>