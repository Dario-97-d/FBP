<?php require_once 'backend/backstart.php'; ?>

<?php

  if (isset($_POST['login-id']))
  {
    $_SESSION['id'] = $_POST['login-id'] / 1;
    REDIRECT('player-overview');
  }

?>

<?php require_once $_FILEREF_frontend_layout; ?>