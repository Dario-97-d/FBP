<?php

	// -- Team functions --
	
	require_once $_FILEREF_team_manage_functions;
	
	// -- Functions --
	
	function TEAM_Manage_Applications_accept_player( $player_id )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return RESULT_fail('invalid player id');
		
		// -- DB operation --
		$accept = SQL_prep_procedure( 'CALL sp_teams_accept_application(?, ?)', array( $_team_id, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $accept );
	}
	
	function TEAM_Manage_Applications_get_applicants()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id          as player_id,
				f.player_name
			FROM  game_users                    u
			JOIN  football_players              f ON f.id        = u.id
			RIGHT JOIN player_team_applications a ON a.player_id = f.id
			WHERE a.team_id = ?',
			array( $_team_id ) );
	}
	
	function TEAM_Manage_Applications_reject_player( $player_id )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$reject = SQL_prep_stmt_one( 'DELETE FROM player_team_applications WHERE team_id = ? AND player_id = ?', array( $_team_id, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $reject );
	}