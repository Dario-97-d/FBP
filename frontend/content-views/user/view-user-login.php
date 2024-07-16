<form method="POST">
	
	<b>Login:</b>
	
	<label for="username" hidden>Login Username</label>
	<input type="text" id="username" name="username" value="<?= $_username ?>" placeholder="Username" required>
	
	<label for="password" hidden>Login Password</label>
	<input type="password" id="password" name="password" placeholder="Password" required>
	
	<input type="submit" class="button1" name="login" value="Login"/>
</form>