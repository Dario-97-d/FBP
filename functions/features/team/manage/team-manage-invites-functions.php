<?php

	// -- Team functions --
	
	require_once $_FILEREF_team_manage_functions;
	
	// -- Functions --
	
	function TEAM_Manage_Invites_get_invitees()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				u.username,
				f.id          as player_id,
				f.player_name
			FROM  game_users               u
			JOIN  football_players         f ON f.id        = u.id
			RIGHT JOIN team_player_invites i ON i.player_id = f.id
			WHERE i.team_id = ?',
			array( $_team_id ) );
	}
	
	function TEAM_Manage_Invites_send( $player_id )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$invite = SQL_prep_stmt_one( 'INSERT INTO team_player_invites (team_id, player_id) VALUES (?, ?)', array( $_team_id, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $invite );
	}
	
	function TEAM_Manage_Invites_withdraw( $player_id )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $player_id ) ) return RESULT_fail('invalid id');
		
		// -- DB operation --
		$withdraw = SQL_prep_stmt_one( 'DELETE FROM team_player_invites WHERE team_id = ? AND player_id = ?', array( $_team_id, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $withdraw );
	}