
<h1>3-a-side</h1>
<p>3-a-side is a Practice mode to develop initial traits, up to 20 Ø</p>

<h2><?= $_partner['player_name'] ?> | &empty; <?= $_partner['rating'] ?></h2>

<?php
	// Partial View: Generic Attributes.
	require_once $_FILEREF_partial_view_generic_attributes;
?>

<form action="play-3-game" method="POST" onsubmit="return confirm('?')">
	<br />
	<button type="submit" name="partner-id" value="<?= $_partner_id ?>">GO</button>
</form>