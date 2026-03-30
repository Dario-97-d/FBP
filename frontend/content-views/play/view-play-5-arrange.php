
<h1>Arrange 5v5</h1>

<h2>Current Selection</h2>

<div class="display-play-5-selected-players">
	
	<!-- Header -->
	<div class="display-header">#</div>
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
			
			<div class="display-header"><?= $i ?></div>
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
			
			<div class="display-header"><?= $i ?></div>
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
	<div class="display-header grid-span-col-2">Total</div>
	<div class="display-header"><?= $_total_atts['strength']  ?></div>
	<div class="display-header"><?= $_total_atts['movement']  ?></div>
	<div class="display-header"><?= $_total_atts['skill']     ?></div>
	<div class="display-header"><?= $_total_atts['attacking'] ?></div>
	<div class="display-header"><?= $_total_atts['defending'] ?></div>
	<div class="display-header"><?= $_total_atts['rating']    ?></div>
	
</div>

<div class="display-play-5-selection-options">

	<form class="grid-ignore-element" method="POST" onsubmit="return confirm(event.submitter.value + '?')">
		
		<input
			type="submit"
			name="select-gk-bot"
			value="<?= $_is_gk_bot_selected ? 'Remove GK - Bot' : 'Select GK - Bot' ?>"
			<?=
				$_is_gk_bot_selected ? '' : ( $_is_selection_full ? 'disabled' : '' )
			?>
		>
		
		<input type="submit" name="clear-selection" value="Clear Selection" <?= $_clear_selection_disabled ?>>
		
		<input type="submit" name="use-bots" value="Use bots" class="grid-span-col-2" <?= $_is_selection_full ? 'disabled' : '' ?>>
		
	</form>

</div>

<?php

	if ( ! $_is_selection_full )
	{
		if ( is_array( $_teammates_for_selection ) )
		{
			?>
			
			<h2>Teammates</h2>
			
			<form method="POST">
				
				<div class="display-play-5-arrange-players">
					
					<!-- Header -->
					<div class="display-header">Player</div>
					<div class="display-header">STR</div>
					<div class="display-header">MOV</div>
					<div class="display-header">SKL</div>
					<div class="display-header">ATK</div>
					<div class="display-header">DFS</div>
					<div class="display-header">Pick</div>
					
					<!-- Body -->
					<?php
					
						foreach( $_teammates_for_selection as $row )
						{
							?>
							
							<div class="display-body player-name"><?= $row['player_name'] ?></div>
							<div class="display-body"><?= $row['strength']  ?></div>
							<div class="display-body"><?= $row['movement']  ?></div>
							<div class="display-body"><?= $row['skill']     ?></div>
							<div class="display-body"><?= $row['attacking'] ?></div>
							<div class="display-body"><?= $row['defending'] ?></div>
							<div class="display-body">
								<input type="checkbox" name="selected-ids[]" value="<?= $row['player_id'] ?>">
							</div>
							
							<?php
						}
					
					?>
					
				</div>
				
				<input type="submit" name="select-players" value="Select">
				
			</form>
			
			<?php
		}
		else 
		{
			?>
			
			<h3><a href="ranking-player">Search additional teammates</a></h3>
			
			<?php
		}
	}
	else
	{
		?>
		
		<form action="play-5-game" method="POST">
			
			<input type="submit" name="play-5" value="GO">
			
		</form>
		
		<?php
	}

?>