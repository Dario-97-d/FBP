
<h1>Teams</h1>

<table class="table2" style="width:512px;" cellpadding="8" cellspacing="0">
	<tr>
		<th width="64px">Rank</th>
		<th width="64px">Class</th>
		<th width="128px">Team</th>
		<th width="64px">Members</th>
		<th width="64px">RTG</th>
	</tr>
	
	<?php
	
		if ( is_array( $_teams ) )
		{
			$r = 0;
			foreach ( $_teams as $row )
			{
				$r++;
				?>
				
				<tr>
				
					<!-- # -->
					<td>
						<?= $r ?>
					</td>
					
					<!-- Class -->
					<td>
						<?= $row['team_class'] ?>
					</td>
					
					<!-- Team -->
					<td>
						<a href="team-profile?id=<?= $row['id'] ?>"><?= $row['team_name'] ?></a>
					</td>
					
					<!-- Members -->
					<td>
						<?= $row['members'] ?>
					</td>
					
					<!-- Rating -->
					<td>
						<?= $row['rating'] ?>
					</td>
				
				</tr>
				
				<?php
			}
		}
	
	?>
	
</table>

<?php
	// Partial View: Search Team.
	require_once $_FILEREF_partial_view_search_team;
?>