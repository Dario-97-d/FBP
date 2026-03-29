<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		
		<title><?= PAGE_get_title() ?></title>
		
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="css/layout.css">
		<link rel="stylesheet" href="<?= $_CSSREF_bottom_nav ?>">
		<link rel="stylesheet" href="css/style.css">
		<?= CSS_render_stylesheets() ?>
	</head>

	<body>

		<?php /* Show all dialog entries */ ?>
		<?= DIALOG_all() ?>
		
		<header>
			<a href="index">FBP</a>
		</header>

		<hr color="purple" style="margin-bottom: 0.5rem;">
		
		<main>
			
			<div class="main-content">
				<?php require_once $_FILEREF_frontend_content; ?>
			</div>
			
			<?php require_once $_FILEREF_partial_bottom_nav; ?>
			
		</main>

		<footer>FBP (C)</footer>
		
		<script src="<?= $_JSREF_partial_bottom_nav ?>"></script>
		<?= JS_render_scripts() ?>

	</body>

</html>
