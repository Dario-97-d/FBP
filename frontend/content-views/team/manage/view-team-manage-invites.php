
<h1><?= $_team_name ?></h1>

<h2>Invite players</h2>

<?php
	// Partial View: Search Player.
	require_once $_FILEREF_partial_view_search_player;
?>

<h2>Invites</h2>

<div class="display-team-invites">
	
	<?php
	
		if ( is_array( $_invitees ) )
		{
			foreach ( $_invitees as $row )
			{
				?>
				
				<!-- Username -->
				<div class="display-team-invites-body at-username">@<?= $row['username'] ?></div>
				
				<!-- Player name -->
				<div class="display-team-invites-body">
					<a href="player-profile?id=<?= $row['player_id'] ?>">
						<?= $row['player_name'] ?>
					</a>
				</div>
				
				<!-- Withdraw Invite -->
				<div class="display-team-invites-body">
					<form method="POST" onsubmit="return confirm('Withdraw invite to <?= $row['player_name'] ?>?')">
						<input type="hidden" name="withdraw-player-id" value="<?= $row['player_id'] ?>" />
						<input type="submit" value="Withdraw" />
					</form>
				</div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-team-invites-body grid-span-col-3">None</div>
			
			<?php
		}
	
	?>
	
</div>