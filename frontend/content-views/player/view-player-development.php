
<h1><?= $_player['name'] ?></h1>

<!-- Display Generic Attributes Upgrade -->
<div class="display-generic-attributes-upgrade">
	
	<!-- Available Points -->
	<div class="display-generic-attributes-upgrade-header grid-span-col-5">
		Available: <?= $_player['available_points'] ?>
	</div>
	
	<!-- Generic Attributes Abreviations -->
	<div class="display-generic-attributes-upgrade-body">STR</div>
	<div class="display-generic-attributes-upgrade-body">MOV</div>
	<div class="display-generic-attributes-upgrade-body">SKL</div>
	<div class="display-generic-attributes-upgrade-body">ATK</div>
	<div class="display-generic-attributes-upgrade-body">DFS</div>
	
	<!-- Generic Attributes Values -->
	<div class="display-generic-attributes-upgrade-body"><?= $_player['strength']  ?></div>
	<div class="display-generic-attributes-upgrade-body"><?= $_player['movement']  ?></div>
	<div class="display-generic-attributes-upgrade-body"><?= $_player['skill']     ?></div>
	<div class="display-generic-attributes-upgrade-body"><?= $_player['attacking'] ?></div>
	<div class="display-generic-attributes-upgrade-body"><?= $_player['defending'] ?></div>
	
	<!-- Upgrade Buttons for each Generic Attribute -->
	<form class="grid-ignore-element" method="POST" onsubmit="return confirm('Upgrade '+ event.submitter.name +'?')">
		<input type="hidden" name="upgrade-generic-attribute">
		
		<div class="display-generic-attributes-upgrade-body"><input type="submit" name="strength"  value="+" <?= $_generic_upgrade_disabled ?>></div>
		<div class="display-generic-attributes-upgrade-body"><input type="submit" name="movement"  value="+" <?= $_generic_upgrade_disabled ?>></div>
		<div class="display-generic-attributes-upgrade-body"><input type="submit" name="skill"     value="+" <?= $_generic_upgrade_disabled ?>></div>
		<div class="display-generic-attributes-upgrade-body"><input type="submit" name="attacking" value="+" <?= $_generic_upgrade_disabled ?>></div>
		<div class="display-generic-attributes-upgrade-body"><input type="submit" name="defending" value="+" <?= $_generic_upgrade_disabled ?>></div>
		
	</form>
	
	<!-- Rating -->
	<div class="display-generic-attributes-upgrade-header grid-span-col-5">
		RTG: <?= $_player['rating'] ?>
	</div>
	
</div>

<br />
<hr color="purple" width="394">
<br />

<!-- Display Playing Attributes Upgrade -->
<div class="display-playing-attributes-upgrade">
	
	<!-- Header -->
	<div class="display-playing-attributes-upgrade-header">Physical</div>
	<div class="display-playing-attributes-upgrade-header">Technical</div>
	<div class="display-playing-attributes-upgrade-header">Tactical</div>
	
	<!-- Body -->
	
	<form class="grid-ignore-element" method="POST" onsubmit="return confirm('Upgrade '+ event.submitter.name +'?')">
		
		<!-- Physical -->
		<div class="display-playing-attributes-upgrade-body">
			
			<!-- Speed -->
			<div class="display-playing-attributes-upgrade-body-cell">Speed</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['speed'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="speed" value="+" <?= $_upgradeable_atts['speed'] ? '' : 'disabled' ?>></div>
			
			<!-- Agility -->
			<div class="display-playing-attributes-upgrade-body-cell">Agility</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['agility'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="agility" value="+" <?= $_upgradeable_atts['agility'] ? '' : 'disabled' ?>></div>
			
			<!-- Airplay -->
			<div class="display-playing-attributes-upgrade-body-cell">Airplay</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['airplay'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="airplay" value="+" <?= $_upgradeable_atts['airplay'] ? '' : 'disabled' ?>></div>
			
			<!-- Power -->
			<div class="display-playing-attributes-upgrade-body-cell">Power</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['power'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="power" value="+" <?= $_upgradeable_atts['power'] ? '' : 'disabled' ?>></div>
			
		</div>
		
		<!-- Technical -->
		<div class="display-playing-attributes-upgrade-body">
			
			<!-- Dribble -->
			<div class="display-playing-attributes-upgrade-body-cell">Dribble</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['dribble'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="dribble" value="+" <?= $_upgradeable_atts['dribble'] ? '' : 'disabled' ?>></div>
			
			<!-- Pass -->
			<div class="display-playing-attributes-upgrade-body-cell">Pass</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['pass'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="pass" value="+" <?= $_upgradeable_atts['pass'] ? '' : 'disabled' ?>></div>
			
			<!-- Shoot -->
			<div class="display-playing-attributes-upgrade-body-cell">Shoot</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['shoot'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="shoot" value="+" <?= $_upgradeable_atts['shoot'] ? '' : 'disabled' ?>></div>
			
			<!-- Tackle -->
			<div class="display-playing-attributes-upgrade-body-cell">Tackle</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['tackle'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="tackle" value="+" <?= $_upgradeable_atts['tackle'] ? '' : 'disabled' ?>></div>
			
		</div>
		
		<!-- Tactical -->
		<div class="display-playing-attributes-upgrade-body">
			
			<!-- Position -->
			<div class="display-playing-attributes-upgrade-body-cell">Position</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['position'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="position" value="+" <?= $_upgradeable_atts['position'] ? '' : 'disabled' ?>></div>
			
			<!-- Vision -->
			<div class="display-playing-attributes-upgrade-body-cell">Vision</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['vision'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="vision" value="+" <?= $_upgradeable_atts['vision'] ? '' : 'disabled' ?>></div>
			
			<!-- Prevision -->
			<div class="display-playing-attributes-upgrade-body-cell">Prevision</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['prevision'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="prevision" value="+" <?= $_upgradeable_atts['prevision'] ? '' : 'disabled' ?>></div>
			
			<!-- Marking -->
			<div class="display-playing-attributes-upgrade-body-cell">Marking</div>
			<div class="display-playing-attributes-upgrade-body-cell"><?= $_player['marking'] ?></div>
			<div class="display-playing-attributes-upgrade-body-cell"><input type="submit" class="button-upgrade-playing-attribute" name="marking" value="+" <?= $_upgradeable_atts['marking'] ? '' : 'disabled' ?>></div>
			
		</div>
		
	</form>
	
</div>