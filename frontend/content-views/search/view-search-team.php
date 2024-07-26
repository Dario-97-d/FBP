
<h2>Search Team</h2>

<?php
	// Partial View: Search Team.
	require_once $_FILEREF_partial_view_search_team;
?>

<br />

<div class="display-search-results display-search-results-teams">
	
	<?php
	
		if ( is_array( $_teams_found ) )
		{
			?>
			
			<div class="display-search-results-header">Class</div>
			<div class="display-search-results-header">Team</div>
			<div class="display-search-results-header">Rating</div>
			<div class="display-search-results-header">Members</div>
			
			<?php
			foreach ( $_teams_found as $row )
			{
				?>
				
				<!-- Class -->
				<div class="display-search-results-body"><?= $row['team_class'] ?></div>
				
				<!-- Team Name -->
				<div class="display-search-results-body">
					<a href="team-profile?id=<?= $row['team_id'] ?>">
						<?= $row['team_name'] ?>
					</a>
				</div>
				
				<!-- Rating -->
				<div class="display-search-results-body"><?= $row['rating'] ?></div>
				
				<!-- Members -->
				<div class="display-search-results-body"><?= $row['members'] ?></div>
				
				<?php
			}
		}
		else
		{
			?>
			
			<div class="display-search-results-body grid-span-col-4">No results.</div>
			
			<?php
		}
	
	?>
	
</div>