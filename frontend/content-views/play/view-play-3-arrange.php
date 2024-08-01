
<h1>Play 3v3</h1>
<p>Partner game mode for complementary development of players</p>

<div class="display-generic-attributes-play-3">
	
	<!-- Player -->
	<div class="display-generic-attributes-play-3-header grid-span-col-5"><?= $_player['player_name'] ?> | <?= $_player['rating'] ?></div>
	
	<div class="display-generic-attributes-play-3-body"><?= $_player['strength']  ?></div>
	<div class="display-generic-attributes-play-3-body"><?= $_player['movement']  ?></div>
	<div class="display-generic-attributes-play-3-body"><?= $_player['skill']     ?></div>
	<div class="display-generic-attributes-play-3-body"><?= $_player['attacking'] ?></div>
	<div class="display-generic-attributes-play-3-body"><?= $_player['defending'] ?></div>
	
	<!-- Header -->
	<div class="display-generic-attributes-play-3-header">STR</div>
	<div class="display-generic-attributes-play-3-header">MOV</div>
	<div class="display-generic-attributes-play-3-header">SKL</div>
	<div class="display-generic-attributes-play-3-header">ATK</div>
	<div class="display-generic-attributes-play-3-header">DFS</div>
	
	<!-- Partner -->
	<div class="display-generic-attributes-play-3-body"><?= $_partner['strength']  ?></div>
	<div class="display-generic-attributes-play-3-body"><?= $_partner['movement']  ?></div>
	<div class="display-generic-attributes-play-3-body"><?= $_partner['skill']     ?></div>
	<div class="display-generic-attributes-play-3-body"><?= $_partner['attacking'] ?></div>
	<div class="display-generic-attributes-play-3-body"><?= $_partner['defending'] ?></div>
	
	<div class="display-generic-attributes-play-3-header grid-span-col-5"><?= $_partner['player_name'] ?> | <?= $_partner['rating'] ?></div>
	
</div>

<form action="play-3-game" method="POST" onsubmit="return confirm('?')">
	<br />
	<button type="submit" name="partner-id" value="<?= $_partner_id ?>">GO</button>
</form>