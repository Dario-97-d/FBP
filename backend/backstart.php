<?php
	
	// File reference variables.
	require_once 'file-references.php';
	
	// General functions.
	require_once $_FILEREF_logger_functions;
	require_once $_FILEREF_result_functions;
	require_once $_FILEREF_sql_functions;
	
	// Request handling functions.
	require_once $_FILEREF_auth_functions;
	require_once $_FILEREF_input_handling_functions;
	require_once $_FILEREF_url_functions;
	
	// Response resolution functions.
	require_once $_FILEREF_dialog_functions;
	require_once $_FILEREF_die_functions;
	require_once $_FILEREF_redirect_functions;
	
	// Frontend.
	require_once $_FILEREF_js_functions;
	require_once $_FILEREF_js_references;
	
	// Attempt MySQL connection.
	SQL_connect() or DIE_error();
	
	// Use session.
	session_start();// $_SESSION['id'] = 1;
	
	// Global variables.
	$_CURRENT_PAGE_NAME = URL_get_page_name();
	$_IS_LOGGED_IN = AUTH_is_logged_in();
	
	AUTH_manage_user_access();
	
	if ( $_IS_LOGGED_IN )
	{
		// These variables are needed for logged in user actions.
		$_user_id = $_SESSION['id'];
		$_player_id = $_SESSION['id'];
	}