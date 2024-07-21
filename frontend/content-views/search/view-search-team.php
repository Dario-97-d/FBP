
<h2>Search Team</h2>

<?php
	// Partial View: Search Team.
	require_once $_FILEREF_partial_view_search_team;
?>

<br />

<table class="table1" cellpadding="8" cellspacing="0">
	
	<?php
	
		if ( is_array( $_teams_found ) )
		{
			?>
			
			<tr>
				<th>Class</th>
				<th>Team name</th>
				<th>Rating</th>
				<th>Members</th>
			</tr>
			
			<?php
			foreach ( $_teams_found as $row )
			{
				?>
				
				<tr>
				
					<!-- Class -->
					<td>
						<?= $row['team_class'] ?>
					</td>
					
					<!-- Team Name -->
					<td>
						<a href="team-profile?id=<?= $row['team_id'] ?>"><?= $row['team_name'] ?></a>
					</td>
					
					<!-- Rating -->
					<td>
						<?= $row['rating'] ?>
					</td>
					
					<!-- Members -->
					<td>
						<?= $row['members'] ?>
					</td>
				
				</tr>
				
				<?php
			}
		}
		else
		{
			?>
			
			<tr><td>No results.</td></tr>
			
			<?php
		}
	
	?>
	
</table>