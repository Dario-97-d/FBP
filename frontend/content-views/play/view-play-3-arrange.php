
<h1>3-a-side</h1>
<p>3-a-side is a Practice mode to develop initial traits, up to 20 Ø</p>

<h2><?= $_partner['player_name'] ?> | &empty; <?= $_partner['rating'] ?></h2>

<table class="table2" cellpadding="8" cellspacing="0">
	<tr>
		<th width="48px">STR</th>
		<th width="48px">MOV</th>
		<th width="48px">SKL</th>
		<th width="48px">ATK</th>
		<th width="48px">DFS</th>
	</tr>
	<tr>
		<td><?= $_partner['strength'] ?></td>
		<td><?= $_partner['movement'] ?></td>
		<td><?= $_partner['skill'] ?></td>
		<td><?= $_partner['attacking'] ?></td>
		<td><?= $_partner['defending'] ?></td>
	</tr>
</table>

<form action="play-3-game" method="POST" onsubmit="return confirm('?')">
	<br />
	<button type="submit" name="partner-id" value="<?= $_partner_id ?>">GO</button>
</form>