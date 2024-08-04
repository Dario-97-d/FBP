<?php

	// -- Team functions --
	
	require_once $_FILEREF_team_manage_functions;
	
	// -- Functions --
	
	function TEAM_Manage_Name_get_change_info()
	{
		global $_team_id;
		
		// -- DB operation --
		return SQL_prep_get_row(
			'SELECT
				team_name                                           as current_name,
				last_name_change                                    as last_change,
				last_name_change < DATE_SUB(now(), INTERVAL 1 week) as is_allowed
			FROM  teams
			WHERE id = ?',
			array( $_team_id ) );
	}
	
	function TEAM_Manage_Name_update( $new_name )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		$check_new_name = INPUT_handle_team_name( $new_name );
		
		// Exit if input isn't valid.
		if ( $check_new_name['failed'] ) return RESULT_fail( 'invalid team name' );
		
		$new_name_handled = $check_new_name['handled'];
		
		// -- DB operation --
		$update = SQL_prep_stmt_one(
			'UPDATE teams
			SET
				team_name        = ?,
				last_name_change = CURRENT_TIMESTAMP
			WHERE
				id = ?
				AND
				date( last_name_change ) < date( DATE_SUB( NOW(), INTERVAL 1 WEEK ) )',
			array( $new_name_handled, $_team_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $update );
	}