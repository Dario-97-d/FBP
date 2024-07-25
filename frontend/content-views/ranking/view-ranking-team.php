
<h1>Teams</h1>

<div class="display-ranking display-ranking-teams">
	
	<!-- Header -->
	<div class="display-ranking-header">Rank</div>
	<div class="display-ranking-header">Class</div>
	<div class="display-ranking-header">Name</div>
	<div class="display-ranking-header">Members</div>
	<div class="display-ranking-header">Rating</div>
	
	<!-- Body -->
	
	<?php
	
		if ( is_array( $_teams ) )
		{
			$r = 0;
			foreach ( $_teams as $row )
			{
				$r++;
				?>
					
				<!-- Rank -->
				<div class="display-ranking-body"><?=  $r ?></div>
				
				<!-- Class -->
				<div class="display-ranking-body"><?= $row['team_class'] ?></div>
				
				<!-- Team -->
				<div class="display-ranking-body">
					<a href="team-profile?id=<?= $row['id'] ?>">
						<?= $row['team_name'] ?>
					</a>
				</div>
				
				<!-- Members -->
				<div class="display-ranking-body"><?= $row['members']    ?></div>
				
				<!-- Rating -->
				<div class="display-ranking-body"><?= $row['rating']     ?></div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-ranking-body grid-span-col-5">None</div>
			
			<?php
		}
	
	?>
	
</div>

<?php
	// Partial View: Search Team.
	require_once $_FILEREF_partial_view_search_team;
?>