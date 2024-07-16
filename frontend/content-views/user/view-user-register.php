
<h1>Register</h1>
<form method="POST" data-register="true">
	
	<label for="username">Username:</label>
	<br />
	<input type="text" id="username" name="username" value="<?= $_username ?>" autocomplete="off" required>
	<br />
	
	<label for="player-name">Player name:</label>
	<br />
	<input type="text" id="player-name" name="player-name" value="<?= $_player_name ?>" autocomplete="off" required>
	<br />
	
	<label for="password">Password:</label>
	<br />
	<input type="password" id="password" name="password" autocomplete="off" required>
	<br />
	
	<label for="email">E-mail:</label>
	<br />
	<input type="email" id="email" name="email" value="<?= $_email ?>" autocomplete="off" required>
	<br />
	
	<br />
	<input type="submit" name="register" value="Register" />
</form>

<?php /* Include scripts */ ?>
<?php JS_add_script( $_JSREF_validate_email ) ?>
<?php JS_add_script( $_JSREF_validate_password ) ?>
<?php JS_add_script( $_JSREF_validate_player_name ) ?>
<?php JS_add_script( $_JSREF_validate_username ) ?>
<?php JS_add_script( $_JSREF_on_submit_register ) ?>