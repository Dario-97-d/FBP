
<h1><?= $_player['name'] ?></h1>

<table class="table2" cellpadding="8">
	<tr>
		<th colspan="5">Available: <?= $_player['available_points'] ?></th>
	</tr>
	
	<tr>
		<td>STR</td>
		<td>MOV</td>
		<td>SKL</td>
		<td>ATK</td>
		<td>DFS</td>
	</tr>
	
	<tr>
		<td><?= $_player['strength']  ?></td>
		<td><?= $_player['movement']  ?></td>
		<td><?= $_player['skill']     ?></td>
		<td><?= $_player['attacking'] ?></td>
		<td><?= $_player['defending'] ?></td>
	</tr>
	
	<tr>
		<form method="POST" onsubmit="return confirm('Upgrade '+ event.submitter.name +'?')">
			<input type="hidden" name="upgrade-generic-attribute">
			
			<td><input type="submit" name="strength"  value="+" class="button-upgrade-generic-attribute" <?= $_generic_upgrade_disabled ?>></td>
			<td><input type="submit" name="movement"  value="+" class="button-upgrade-generic-attribute" <?= $_generic_upgrade_disabled ?>></td>
			<td><input type="submit" name="skill"     value="+" class="button-upgrade-generic-attribute" <?= $_generic_upgrade_disabled ?>></td>
			<td><input type="submit" name="attacking" value="+" class="button-upgrade-generic-attribute" <?= $_generic_upgrade_disabled ?>></td>
			<td><input type="submit" name="defending" value="+" class="button-upgrade-generic-attribute" <?= $_generic_upgrade_disabled ?>></td>
		</form>
	</tr>
	
	<tr>
		<th colspan="5">RTG: <?= $_player['rating'] ?></th>
	</tr>
</table>

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