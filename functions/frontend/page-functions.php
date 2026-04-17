<?php

	// -- Page functions --
	
	function PAGE_get_title()
	{
		global $_CURRENT_PAGE_NAME;
		
		// This is available only in Profile pages.
		global $_profile_id;
		
		return match( $_CURRENT_PAGE_NAME )
		{
			'error'                    => 'FBP - ERROR',
			'index'                    => 'FBP',
			''                         => 'FBP',
			
			// User.
			'user-login'               => 'FBP - Login',
			'user-register'            => 'FBP - Register',
			'user-settings'            => 'FBP - User Settings',
			
			// Player.
			'player-development'       => 'FBP - Player Development',
			'player-overview'          => 'FBP - Player Overview',
			'player-profile'           => 'FBP - Player Profile '.$_profile_id,
			
			// Play.
			'play-3'                   => 'FBP - Play 3v3',
			'play-3-arrange'           => 'FBP - Arrange Play-3',
			'play-3-game'              => 'FBP - 3-a-side',
			'play-5'                   => 'FBP - Play 5v5',
			'play-5-arrange'           => 'FBP - Arrange Play-5',
			'play-5-game'              => 'FBP - 5-a-side',
			'play-7-arrange'           => 'FBP - Arrange Play-7',
			'play-7-arrange-formation' => 'FBP - Play-7 Formation',
			'play-7-arrange-selection' => 'FBP - Play-7 Selection',
			'play-eleven'              => 'FBP - Play-11',
			
			// Team.
			'team-center'              => 'FBP - Team Center',
			'team-create'              => 'FBP - Create Team',
			'team-overview'            => 'FBP - Team Overview',
			'team-profile'             => 'FBP - Team Profile '.$_profile_id,
			
			// Team Management.
			'team-manage'              => 'FBP - Team Management',
			'team-manage-applications' => 'FBP - Team applications',
			'team-manage-invites'      => 'FBP - Team Invites',
			'team-manage-members'      => 'FBP - Team Members',
			'team-manage-name'         => 'FBP - Team Name',
			'team-manage-upgrade'      => 'FBP - Team Upgrade',
			
			// Ranking.
			'ranking-player'           => 'FBP - Ranking Players',
			'ranking-team'             => 'FBP - Ranking Teams',
			
			// Search.
			'search-player'            => 'FBP - Search Player',
			'search-team'              => 'FBP - Search Team',
			
			// Mates.
			'mates-overview'           => 'FBP - Mates Overview',
			'mates-requests'           => 'FBP - Mate Requests received',
			'mates-sent'               => 'FBP - Mate Requests sent',
			
			// Mail.
			'mail-box'                 => 'FBP - Mail Box',
			'mail-send'                => 'FBP - Mail Sent',
			'mail-sent'                => 'FBP - Send Mail',
			
			// Guide.
			'guide-playing'            => 'FBP - Game Guide',
			'guide-player'             => 'FBP - Player Guide',
			'guide-team'               => 'FBP - Team Guide',
			
			default => 'FBP'
		};
	}