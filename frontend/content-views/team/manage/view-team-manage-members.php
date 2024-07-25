
<h1><?= $_team_name ?></h1>

<h2>Admin Members</h2>

<div class="display-own-team-members">
	
	<!-- Header -->
	<div class="display-own-team-members-header">Staff Role</div>
	<div class="display-own-team-members-header">Username</div>
	<div class="display-own-team-members-header">Player</div>
	<div class="display-own-team-members-header">Rating</div>
	
	<!-- Body -->
	
	<?php
	
		foreach ( $_team_members as $row )
		{
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
	
	?>
	
</div>

<!--
<h2>Set member as:</h2>

<form method="POST" onsubmit="return confirm('?')">
	
	<select name="player-id">
		<option hidden="true">Select Member</option>
		
		<?php
		
			foreach ( $_select_members as $id => $name ) {
				echo '<option value="'.$id.'">'.$name.'</option>';
			}
		
		?>
		
	</select>
	
	<select name="staff-role">
		<option hidden="true">Select Role</option>
		<option>Admin</option>
		<option>Boss</option>
		<option>Captain</option>
		<option>Dweller</option>
		<option>Element</option>
		<option>Free</option>
	</select>
	
	<br />
	<div style="padding: 8px 0 0 0"><input type="submit" class="button1" name="set-player-as" value="Set" /></div>
	
</form>
-->

<h2>Expel member</h2>

<form method="POST" onsubmit="return confirm('Expel '+ document.getElementById('input-username').value +'?')">
	<input type="text" id="input-username" name="expel-player-at-username" placeholder="@username" autocomplete="off" required>
	<br />
	<input type="submit" value="Expel">
</form>