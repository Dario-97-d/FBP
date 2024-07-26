
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

<table class="table1 table-training-atts">
	
	<tr>
		<th>Physical</th>
		<th>Technical</th>
		<th>Tactical</th>
	</tr>
	
	<tr>
		
		<form method="POST" onsubmit="return confirm('Upgrade '+ event.submitter.name +'?')">
			<input type="hidden" name="upgrade-playing-attribute">
			
			<td>
				<table>
					<tr>
						<td>Speed:</td>
						<td><?= $_player['speed'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="speed" value="+" <?= $_upgradeable_atts['speed'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Agility:</td>
						<td><?= $_player['agility'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="agility" value="+" <?= $_upgradeable_atts['agility'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Airplay:</td>
						<td><?= $_player['airplay'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="airplay" value="+" <?= $_upgradeable_atts['airplay'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Power:</td>
						<td><?= $_player['power'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="power" value="+" <?= $_upgradeable_atts['power'] ? '' : 'disabled' ?>></td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
						<td>Dribble:</td>
						<td><?= $_player['dribble'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="dribble" value="+" <?= $_upgradeable_atts['dribble'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Pass:</td>
						<td><?= $_player['pass'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="pass" value="+" <?= $_upgradeable_atts['pass'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Shoot:</td>
						<td><?= $_player['shoot'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="shoot" value="+" <?= $_upgradeable_atts['shoot'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Tackle:</td>
						<td><?= $_player['tackle'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="tackle" value="+" <?= $_upgradeable_atts['tackle'] ? '' : 'disabled' ?>></td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
						<td>Position:</td>
						<td><?= $_player['position'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="position" value="+" <?= $_upgradeable_atts['position'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Vision:</td>
						<td><?= $_player['vision'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="vision" value="+" <?= $_upgradeable_atts['vision'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Prevision:</td>
						<td><?= $_player['prevision'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="prevision" value="+" <?= $_upgradeable_atts['prevision'] ? '' : 'disabled' ?>></td>
					</tr>
					<tr>
						<td>Marking:</td>
						<td><?= $_player['marking'] ?></td>
						<td><input type="submit" class="button-upgrade-playing-attribute" name="marking" value="+" <?= $_upgradeable_atts['marking'] ? '' : 'disabled' ?>></td>
					</tr>
				</table>
			</td>
			
		</form>
		
	</tr>
	
</table>