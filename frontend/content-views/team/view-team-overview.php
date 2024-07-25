
<h1><?= $_team['team_name'] ?></h1>

<h2>Class <?= $_team['team_class'] ?> | <?= $_team['rating'] ?> &empty;</h2>

<h3><?= $_team['members'] ?> members</h3>

<div class="display-own-team-members">
	
	<!-- Header -->
	<div class="display-own-team-members-header">Staff Role</div>
	<div class="display-own-team-members-header">Username</div>
	<div class="display-own-team-members-header">Player</div>
	<div class="display-own-team-members-header">Rating</div>
	
	<!-- Body -->
	
	<?php
	
		$r = 0;
		
		foreach ( $_team_members as $row )
		{
			$r++;
			?>
			
			<!-- Staff Role -->
			<div class="display-own-team-members-body"><?= $row['staff_role'] ?></div>
			
			<!-- Username -->
			<div class="display-own-team-members-body at-username">@<?= $row['username'] ?></div>
			
			<!-- Player name -->
			<div class="display-own-team-members-body">
				<a href="player-profile?id=<?= $row['player_id'] ?>">
					<?= $row['player_name'] ?>
				</a>
			</div>
			
			<!-- Rating -->
			<div class="display-own-team-members-body"><?= $row['player_rating'] ?></div>
			
			<?php
		}
		
		// Display additional rows, up to 5 in total.
		while ( $r < 5 )
		{
			$r++;
			?>
			
			<div class="display-own-team-members-body"><?= $r ?></div>
			<div class="display-own-team-members-body">-</div>
			<div class="display-own-team-members-body">-</div>
			<div class="display-own-team-members-body">-</div>
			
			<?php
		}
	
	?>
	
</div>

<?php

	if ( $_show_link_management )
	{
		?>
		
		<h2><a href="team-manage">Management</a></h2>
		
		<?php
	}

?>

<h2><a href="play-5">Play 5v5</a></h2>
<h2><a href="team-center">Team center</a></h2>