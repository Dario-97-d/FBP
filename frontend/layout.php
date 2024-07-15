<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		
		<title>FBP</title>
		
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>

	<body>

		<?php /* Show all dialog entries */ ?>
		<?= DIALOG_all() ?>
		
		<div>
			<a href="index">FBP</a>
		</div>

		<hr color="purple">
		
		<div class="content">
			
			<?php require_once $_FILEREF_partial_view_top_bar; ?>
			
			<?php require_once $_FILEREF_frontend_content; ?>
			
			<h4><u onclick="history.back()">Back</u></h4>
			
			<?php
				if ( $_IS_LOGGED_IN ) require_once $_FILEREF_partial_view_logout_link;
				else echo '<a href="user-login">Login</a><br /><a href="user-register">Register</a>';
			?>
			
			<?php /*require_once $_FILEREF_partial_view_website_map;*/ ?>
			
		</div>

		<div class="footer">FBP (C)</div>
		
		<?php /* Include required JavaScript */ ?>
		<?= JS_render_scripts() ?>

	</body>

</html>