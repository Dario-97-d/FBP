<h1>3-a-side</h1>

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

<h3>Complementarity: <?= 100 * round( $_result['complementarity'], 2 ) ?>%</h3>

<h2>Team Players <?= $_result['own_score'] ?> - <?= $_result['bot_score'] ?> Team Bots</h2>

<div class="display-field-play-3">
	<div class="rectangle">
		
		<div class="center-line"></div>
		<div class="center-circle"></div>
		
		<div class="area own-area"></div>
		<div class="area other-area"></div>
		
		<div class="round-icon own-bot-keeper">B</div>
		<div class="round-icon other-bot-keeper">B</div>
		
		<div class="round-icon own-player">P</div>
		<div class="round-icon own-partner">P</div>
		
		<div class="round-icon bot-left">B</div>
		<div class="round-icon bot-right">B</div>
		
	</div>
</div>