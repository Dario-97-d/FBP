<?php

	// -- Team functions --
	
	require_once $_FILEREF_team_manage_functions;
	
	// -- Functions --
	
	function TEAM_Manage_Members_expel( $username )
	{
		global $_team_id;
		
		// -- Handle Input --
		
		$check_username = INPUT_handle_username( $username );
		
		// Exit if input isn't valid.
		if ( $check_username['failed'] ) return RESULT_fail('invalid username');
		
		$username_handled = $check_username['handled'];
		
		// -- DB operation --
		$expel = SQL_prep_procedure( 'CALL sp_teams_expel_player(?, ?)', array( $username_handled, $_team_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $expel );
	}
	
	function TEAM_Manage_Members_get_select_assoc( $members )
	{
		// Avoid having current player in select list.
		global $_player_id;
		
		$select_members = array();
		foreach ( $members as $member )
		{
			// Avoid having current player in select list.
			if ( $member['player_id'] == $_player_id ) continue;
			
			$members[ $member['player_id'] ] = $member['player_name'];
		}
		
		return $select_members;
	}
	
	function TEAM_Manage_Members_update_staff_role( $player_id, $staff_role )
	{
		// -- Handle Input --
		
		// Exit if input isn't valid.
		if ( ! INPUT_is_id_valid        ( $player_id  ) ) return RESULT_fail('invalid player id');
		if ( ! INPUT_is_valid_staff_role( $staff_role ) ) return RESULT_fail('invalid staff role');
		
		// -- DB operation --
		$update = SQL_prep_stmt_one( 'UPDATE player_team SET staff_role = ? WHERE player_id = ?', array( $staff_role, $player_id ) );
		
		// -- Handle result --
		return TEAM_RESULT( $update );
	}