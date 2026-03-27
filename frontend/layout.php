<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		
		<title><?= PAGE_get_title() ?></title>
		
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="css/layout.css">
		<link rel="stylesheet" href="css/style.css">
		<?= CSS_render_stylesheets() ?>
	</head>

	<body>

		<?php /* Show all dialog entries */ ?>
		<?= DIALOG_all() ?>
		
		<div>
			<a href="index">FBP</a>
		</div>

		<hr color="purple">
		
		<div class="frame">
			
			<div class="inner-frame">
				
				<?php require_once $_FILEREF_partial_view_top_bar; ?>
				
				<?php require_once $_FILEREF_frontend_content; ?>
				
				<h4><u onclick="history.back()">Back</u></h4>
				
				<?php
					if ( $_IS_LOGGED_IN ) require_once $_FILEREF_partial_view_logout_link;
					else echo '<a href="user-login">Login</a><br /><a href="user-register">Register</a>';
				?>
				
			</div>
			
		</div>

		<div class="footer">FBP (C)</div>
		
		<?php /* Include required JavaScript */ ?>
		<?= JS_render_scripts() ?>

	</body>

</html>