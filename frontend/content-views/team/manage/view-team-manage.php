
<h1><?= $_team_name ?></h1>

<h2>Management</h2>

<h3><a href="team-manage-applications">Applications</a></h3>
<h3><a href="team-manage-invites">Invite players</a></h3>
<h3><a href="team-manage-members">Admin members</a></h3>
<h3><a href="team-manage-upgrade">Upgrade Team</a></h3>
<h3><a href="team-manage-name">Change name</a></h3>

<form method="POST" onsubmit="return confirm('Eliminate team?')">
	<input type="submit" name="eliminate-team" value="Eliminate team" />
</form>