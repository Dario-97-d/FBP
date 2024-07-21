<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_mail_functions;
	
	$_mail_entries = MAIL_get_sent() or DIALOG_add_mail_fail('could not get sent messages');

?>

<?php require_once $_FILEREF_frontend_layout; ?>