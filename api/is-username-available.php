<?php

	require_once __DIR__ . '/../backend/file-references.php';
	
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_sql_functions;
	
	$_TRUE  = 'true';
	$_FALSE = 'false';
	$_ERROR = 'error';
	
	SQL_connect() or die( $_ERROR );
	
	if ( isset( $_GET['username'] ) )
	{
		$check_username = INPUT_handle_username( $_GET['username'] );
		
		// Exit if username is not valid.
		if ( $check_username['failed'] ) die( $_FALSE );
		
		$username_handled = $check_username['handled'];
		
		$username_exists = SQL_prep_bool_or_null( 'SELECT 1 FROM game_users WHERE username = ?', array( $username_handled ) );
		
		// Return true if check failed (returned null).
		exit( $username_exists ? $_FALSE : $_TRUE );
	}
	else {
		die( $_ERROR );
	}