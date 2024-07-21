<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_mail_functions;
	
	$_mail_entries = MAIL_get_received() or DIALOG_add_mail_fail('could not get received messages');

?>

<?php require_once $_FILEREF_frontend_layout; ?>