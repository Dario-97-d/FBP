<?php require_once 'backend/backstart.php'; ?>

<?php

  require_once $_FILEREF_play_7_functions;

  // -- Switch Formation --
  if ( isset( $_POST['switch-formation'] ) )
  {
    PLAY_7_switch_formation() or DIE_error();

    // Avoid form resubmission.
		REDIRECT_current();
  }

  $_positions_players = PLAY_7_get_positions() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>
