<?php

	// -- Select Content View --
	
	$_CURRENT_PAGE_NAME;

	$pages_to_views = [
		// Generic.
		'error'                    => 'view-error.php',
		'index'                    => 'view-index.php',
		''                         => 'view-index.php',
		
		// User.
		'user-login'               => 'user/view-user-login.php',
		'user-register'            => 'user/view-user-register.php',
		'user-settings'            => 'user/view-user-settings.php',
		
		// Player.
		'player-overview'          => 'player/view-player-overview.php',
		'player-profile'           => 'player/view-player-profile.php',
		
		// Play.
		'play-3-arrange'           => 'play/view-play-3-arrange.php',
		'play-3-game'              => 'play/view-play-3-game.php',
		'play-5'                   => 'play/view-play-5.php',
		'play-seven'               => 'play/view-play-seven.php',
		'play-eleven'              => 'play/view-play-eleven.php',
		
		// Team.
		'team-center'              => 'team/view-team-center.php',
		'team-create'              => 'team/view-team-create.php',
		'team-overview'            => 'team/view-team-overview.php',
		'team-profile'             => 'team/view-team-profile.php',
		
		// Team Management.
		'team-manage'              => 'team/manage/view-team-manage.php',
		'team-manage-applications' => 'team/manage/view-team-manage-applications.php',
		'team-manage-invites'      => 'team/manage/view-team-manage-invites.php',
		'team-manage-members'      => 'team/manage/view-team-manage-members.php',
		'team-manage-name'         => 'team/manage/view-team-manage-name.php',
		'team-manage-upgrade'      => 'team/manage/view-team-manage-upgrade.php',
		
		// Ranking.
		'ranking-player'           => 'ranking/view-ranking-player.php',
		'ranking-team'             => 'ranking/view-ranking-team.php',
		
		// Search.
		'search-player'            => 'search/view-search-player.php',
		'search-team'              => 'search/view-search-team.php',
		
		// Mates.
		'mates-overview'           => 'mates/view-mates-overview.php',
		'mates-requests'           => 'mates/view-mates-requests.php',
		'mates-sent'               => 'mates/view-mates-sent.php',
		
		// Mail.
		'mail-box'                 => 'mail/view-mail-box.php',
		'mail-send'                => 'mail/view-mail-send.php',
		'mail-sent'                => 'mail/view-mail-sent.php',
		
		// Guide.
		'guide-playing'            => 'guide/view-guide-playing.php',
		'guide-player'             => 'guide/view-guide-player.php',
		'guide-team'               => 'guide/view-guide-team.php',
	];
	
	// Get path of directory where views are stored.
	$path = __DIR__ . '/content-views/';
	
	try
	{
		// Check whether the requested page has a corresponding view.
		if ( isset( $pages_to_views[ $_CURRENT_PAGE_NAME ] ) )
		{
			// Require corresponding view.
			require_once $path . $pages_to_views[ $_CURRENT_PAGE_NAME ] ;
		}
		else
		{
			LOGGER_log_fail( 'frontend', 'Page not found: '.$_CURRENT_PAGE_NAME  );
			require_once $path . 'view-index.php';
		}
	}
	catch (Exception $e)
	{
		LOGGER_log_error( 'frontend', 'Could not sort content. $e->getMessage(): '.$e->getMessage() );
		require_once $path . 'view-error.php';
	}