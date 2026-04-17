<?php require_once 'backend/backstart.php'; ?>

<?php

  require_once $_FILEREF_play_7_arrange_selection_functions;
  
  // -- Select Player --
  if ( isset( $_POST['select-player'] ) )
  {
    PLAY_7_Arrange_Selection_select_player( $_POST['player-id'] ?? 0, $_POST['position-number'] ?? '' );
    
    // Avoid form resubmission.
    REDIRECT_current();
  }
  
  // -- Deselect Player --
  if ( isset( $_POST['deselect-player-id'] ) )
  {
    PLAY_7_Arrange_Selection_deselect_player( $_POST['deselect-player-id']);
    
    // Avoid form resubmission.
    REDIRECT_current();
  }
  
  $_team_players = PLAY_7_Arrange_Selection_get_all_players() ?? DIE_error();
  
  $_selected   = PLAY_7_Arrange_Selection_get_selected( $_team_players );
  $_unselected = PLAY_7_Arrange_Selection_get_unselected( $_team_players );

  $_positions           = PLAY_7_get_positions();
  $_available_positions = PLAY_7_Arrange_Selection_get_available_positions( $_positions, $_selected );

?>

<?php require_once $_FILEREF_frontend_layout; ?>
