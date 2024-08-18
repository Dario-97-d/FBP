<?php require_once 'backend/backstart.php'; ?>

<?php

	require_once $_FILEREF_play_5_arrange_functions;
	
	$_team_id = PLAY_5_get_team_id() or REDIRECT('team-center');
	
	// -- Clear Selection --
	if ( isset( $_POST['clear-selection'] ) )
	{
		PLAY_5_clear_selection() or DIE_error();
		
		// Avoid form resubmission.
		REDIRECT_current();
	}
	
	// -- Select GK - Bot --
	if ( isset( $_POST['select-gk-bot'] ) )
	{
		PLAY_5_Arrange_select_gk_bot( $_POST['select-gk-bot'] == 'Select GK - Bot' ) or DIE_error();
		
		// Avoid form resubmission.
		REDIRECT_current();
	}
	
	// -- Select Players --
	if ( isset( $_POST['select-players'] ) )
	{
		if ( isset( $_POST['selected-ids'] ) )
		{
			PLAY_5_Arrange_add_to_selection( $_POST['selected-ids'] ) or DIE_error();
			
			// Avoid form resubmission.
			REDIRECT_current();
		}
		else
		{
			DIALOG_add_input_fail('players are required for selection');
		}
	}
	
	
	$_player = PLAY_5_get_player() or DIE_error();
	
	// Includes GK - Bot.
	$_selected_players = PLAY_5_get_selected_players( $_player ) or DIE_error();
	
	$_total_atts = PLAY_5_get_total_atts( $_selected_players ) or DIE_error();
	
	$_teammates_for_selection = PLAY_5_Arrange_get_teammates_for_selection() or DIE_error();
	
	
	$_clear_selection_disabled = is_array( $_selected_players ) && count( $_selected_players ) > 1 ? '' : 'disabled';
	
	$_is_gk_bot_selected = PLAY_5_is_bot_selected( $_selected_players ) ?? DIE_error();
	
	$_is_selection_full = count( $_selected_players ) === 5;

?>

<?php require_once $_FILEREF_frontend_layout; ?>