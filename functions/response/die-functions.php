<?php

	// -- Die functions --
	
	function DIE_error()
	{
		// -- Get necessary global variables for frontend --
		
		global $_FILEREF_frontend_layout;
		global $_FILEREF_frontend_content;
		
		global $_FILEREF_partial_view_logout_link;
		global $_FILEREF_partial_view_top_bar;
		global $_FILEREF_partial_view_website_map;
		
		global $_IS_LOGGED_IN;
		
		/*
		 * Define (no need to get global)
		 * the name of the page for which to show the frontend.
		 */
		$_CURRENT_PAGE_NAME = 'error';
		
		require_once $_FILEREF_frontend_layout;
		
		// Die.
		die();
	}