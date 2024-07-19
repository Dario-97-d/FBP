
<h1><?= $_name_change['current_name'] ?></h1>

<h2>New team name</h2>
<p>Last name change: <?= $_name_change['last_change'] == '0000-00-00 00:00:00' ? 'never' : $_name_change['last_change'] ?></p>

<?php

	if ( $_name_change['is_allowed'] )
	{
		?>
		
		<form action="team-manage-name" method="POST" onsubmit="return confirm('Update team name to '+ document.getElementById('input-name').value +'?')">
			<div class="input"><input type="text" id="input-name" name="new-team-name" /></div>
			
			<div class="input"><input type="submit" class="button1" value="Submit" /></div>
		</form>
		
		<?php
	}
	else
	{
		?>
		
		<h4>Name change requires 7 days hold</h4>
		
		<?php
	}

?>