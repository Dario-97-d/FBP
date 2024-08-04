<?php

	// -- Player Development functions --
	
	require_once $_FILEREF_player_functions;
	
	// -- Functions --
	
	function PLAYER_Team_accept_invite( $team_id )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return RESULT_fail('invalid team id');
		
		// -- DB operation --
		$accept = SQL_prep_procedure( 'CALL sp_teams_accept_invite(?, ?)', array( $_player_id, $team_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $accept );
	}
	
	function PLAYER_Team_apply( $team_id )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return RESULT_fail('invalid team id');
		
		// -- DB operation --
		$apply = SQL_prep_procedure( 'CALL sp_teams_apply(?, ?)', array( $_player_id, $team_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $apply );
	}
	
	function PLAYER_Team_cancel_application( $team_id )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return RESULT_fail('invalid team id');
		
		// -- DB operation --
		$cancel = SQL_prep_stmt_one( 'DELETE FROM player_team_applications WHERE player_id = ? AND team_id = ?', array( $_player_id, $team_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $cancel );
	}
	
	function PLAYER_Team_get_applications()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				t.id,
				t.team_name
			FROM  player_team_applications a
			JOIN  teams                    t ON a.team_id = t.id
			WHERE a.player_id = ?',
			array( $_player_id ) );
	}
	
	function PLAYER_Team_get_invites()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_get_multi(
			'SELECT
				t.id,
				t.team_name
			FROM  team_player_invites i
			JOIN  teams               t ON i.team_id = t.id
			WHERE i.player_id = ?',
			array( $_player_id ) );
	}
	
	function PLAYER_Team_leave()
	{
		global $_player_id;
		
		// -- DB operation --
		$leave = SQL_prep_stmt_result( "CALL sp_teams_player_leave(?)", array( $_player_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $leave );
	}
	
	function PLAYER_Team_reject_invite( $team_id )
	{
		global $_player_id;
		
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid( $team_id ) ) return RESULT_fail('invalid team id');
		
		// -- DB operation --
		$reject = SQL_prep_stmt_one( 'DELETE FROM team_player_invites WHERE team_id = ? AND player_id = ?', array( $team_id, $_player_id ) );
		
		// -- Handle result --
		return PLAYER_RESULT( $reject );
	}