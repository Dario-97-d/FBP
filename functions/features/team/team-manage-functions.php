<?php

	// -- Team Manage functions --
	
	require_once $_FILEREF_team_functions;
	
	// -- Functions --
	
	function TEAM_Manage_eliminate()
	{
		global $_team_id;
		
		// -- DB operation --
		$eliminate = SQL_prep_procedure( 'CALL sp_teams_eliminate(?)', array( $_team_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $eliminate );
	}
	
	function TEAM_Manage_is_player_allowed()
	{
		global $_player_id;
		
		// -- DB operation --
		return SQL_prep_bool_or_null( 'SELECT 1 FROM player_team WHERE player_id = ? AND staff_role = ?', array( $_player_id, 'Captain' ) );
	}