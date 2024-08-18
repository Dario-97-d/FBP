
<h1>5-a-side</h1>

<div class="display-play-5-selected-players game">
	
	<!-- Header -->
	<div class="display-header">Player</div>
	<div class="display-header">STR</div>
	<div class="display-header">MOV</div>
	<div class="display-header">SKL</div>
	<div class="display-header">ATK</div>
	<div class="display-header">DFS</div>
	<div class="display-header">RTG</div>
	
	<?php
	
		$i = 0;
		foreach ( $_selected_players as $row )
		{
			$i++;
			?>
			
			<div class="display-body player-name"><?= $row['player_name'] ?></div>
			<div class="display-body"><?= $row['strength']  ?></div>
			<div class="display-body"><?= $row['movement']  ?></div>
			<div class="display-body"><?= $row['skill']     ?></div>
			<div class="display-body"><?= $row['attacking'] ?></div>
			<div class="display-body"><?= $row['defending'] ?></div>
			<div class="display-body"><?= $row['rating']    ?></div>
			
			<?php
		}
		
		while ( $i < 5 )
		{
			$i++;
			?>
			
			<div class="display-body player-name">-</div>
			<div class="display-body">-</div>
			<div class="display-body">-</div>
			<div class="display-body">-</div>
			<div class="display-body">-</div>
			<div class="display-body">-</div>
			<div class="display-body">-</div>
			
			<?php
		}
	
	?>
	
	<!-- Total -->
	<div class="display-header">Total</div>
	<div class="display-header"><?= $_total_atts['strength']  ?></div>
	<div class="display-header"><?= $_total_atts['movement']  ?></div>
	<div class="display-header"><?= $_total_atts['skill']     ?></div>
	<div class="display-header"><?= $_total_atts['attacking'] ?></div>
	<div class="display-header"><?= $_total_atts['defending'] ?></div>
	<div class="display-header"><?= $_total_atts['rating']    ?></div>
	
</div>

<div class="display-play-5-game-result">
	
	<div class="display-header">Measure</div>
	<div class="display-header">Balance</div>
	
	<div class="display-body">Physical</div>
	<div class="display-body"><?= round( 100 * $_result['balance']['physical']  ); ?> %</div>
	
	<div class="display-body">Tactical</div>
	<div class="display-body"><?= round( 100 * $_result['balance']['tactical']  ); ?> %</div>
	
	<div class="display-header">Overall</div>
	<div class="display-header"><?= round( 100 * $_result['balance']['overall']   ); ?> %</div>
	
</div>

<h2>Team Players <?= $_result['own_score'] ?> - <?= $_result['bot_score'] ?> Team Bots</h2>

<div class="display-field-play-5">
	<div class="rectangle">
		
		<div class="center-line"></div>
		<div class="center-circle"></div>
		
		<div class="area own-area"></div>
		<div class="area other-area"></div>
		
		<div class="round-icon keeper own-keeper">GK</div>
		<div class="round-icon keeper other-keeper">GK</div>
		
		<div class="round-icon own own-<?= $_positions_players[0] ?>">P</div>
		<div class="round-icon own own-<?= $_positions_players[1] ?>">P</div>
		<div class="round-icon own own-<?= $_positions_players[2] ?>">P</div>
		<div class="round-icon own own-<?= $_positions_players[3] ?>">P</div>
		
		<!--
		<div class="round-icon own own-CB">P</div>
		<div class="round-icon own own-RM">P</div>
		<div class="round-icon own own-CM">P</div>
		<div class="round-icon own own-LM">P</div>
		<div class="round-icon own own-CF">P</div>
		-->

		<div class="round-icon bot bot-<?= $_positions_bots[0] ?>">B</div>
		<div class="round-icon bot bot-<?= $_positions_bots[1] ?>">B</div>
		<div class="round-icon bot bot-<?= $_positions_bots[2] ?>">B</div>
		<div class="round-icon bot bot-<?= $_positions_bots[3] ?>">B</div>
		
		<!--
		<div class="round-icon bot bot-CB">B</div>
		<div class="round-icon bot bot-RM">B</div>
		<div class="round-icon bot bot-CM">B</div>
		<div class="round-icon bot bot-LM">B</div>
		<div class="round-icon bot bot-CF">B</div>
		-->
		
	</div>
</div>