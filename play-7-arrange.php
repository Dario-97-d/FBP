<?php require_once 'backend/backstart.php'; ?>

<?php

  require_once $_FILEREF_play_7_functions;
  
  $_positions_players = PLAY_7_get_positions() or DIE_error();

?>

<?php require_once $_FILEREF_frontend_layout; ?>
