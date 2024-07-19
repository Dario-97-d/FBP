
<h1>Create Team</h1>

<form method="POST" onsubmit="return confirm('Create team '+ document.getElementById('input-name').value +'?')">
	Team Name (4-16 chs):
	<br />
	<input type="text" id="input-name" name="new-team-name" />
	<br />
	<br />
	<input type="submit" value="Start Team" />
</form>