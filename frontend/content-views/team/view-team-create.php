
<h1>Create Team</h1>

<form method="POST" onsubmit="return confirm('Create team '+ document.getElementById('team-name').value +'?')">
	
	<label for="team-name">Team Name</label>
	<br />
	<input type="text" id="team-name" name="new-team-name" required>
	<br />
	<span id="team-name-chars">(4 to 16 characters)</span>
	<br />
	
	<br />
	<input type="submit" value="Start Team">
</form>