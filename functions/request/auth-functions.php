<?php

	// -- Auth functions --
	
	// Require other functions.
	require_once $_FILEREF_user_functions;
	
	function AUTH_is_logged_in()
	{
		if ( isset( $_SESSION['id'] ) )
		{
			// Logout if user is not registered anymore.
			if ( ! USER_exists( $_SESSION['id'] ) )
			{
				session_destroy();
				return false;
			}
		}
		
		return isset( $_SESSION['id'] );
	}
	
	function AUTH_login( $user_id )
	{
		$_SESSION['id'] = $user_id;
		
		session_regenerate_id(true);
	}
	
	function AUTH_manage_user_access()
	{
		global $_CURRENT_PAGE_NAME;
		global $_IS_LOGGED_IN;
		
		/*
		
		Manage user access
		-- General access
		-- Logged in user access
		-- Not logged in user access
		
		*/
		
		// General access pages.
		switch ( $_CURRENT_PAGE_NAME )
		{
			case 'index':
			case 'error':
			
			case 'guide-player':
			case 'guide-playing':
			case 'guide-team':
			
			case 'player-profile':
			case 'team-profile':
			
			case 'ranking-player':
			case 'ranking-team':
			
			case 'search-player':
			case 'search-team':
			
				// Exit function if page is general access.
				return;
		}
		
		// Logged in user access.
		if ( $_IS_LOGGED_IN )
		{
			// Allow logged in users to access these pages.
			switch ( $_CURRENT_PAGE_NAME )
			{
				case 'mail-box':
				case 'mail-send':
				case 'mail-sent':
				
				case 'mates-overview':
				case 'mates-requests':
				case 'mates-sent':
				
				case 'play-11':
				case 'play-3-arrange':
				case 'play-3-game':
				case 'play-5':
				case 'play-7':
				
				case 'player-development';
				case 'player-overview':
				
				case 'team-center':
				case 'team-create':
				case 'team-overview':
				
				case 'team-manage':
				case 'team-manage-applications':
				case 'team-manage-invites':
				case 'team-manage-members':
				case 'team-manage-name':
				case 'team-manage-upgrade':
				
				case 'user-settings':
				
					// Exit function if user is allowed.
					return;
			}
		}
		// Not logged in user access.
		else
		{
			// Allow access to these pages only to not logged in users.
			switch ( $_CURRENT_PAGE_NAME )
			{
				case 'user-register':
				case 'user-login':
				
					// Exit function if user is allowed.
					return;
			}
		}
		
		// Redirect page if user was not allowed access.
		REDIRECT('index');
	}