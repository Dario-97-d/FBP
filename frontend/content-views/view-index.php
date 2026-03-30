
<h1>INDEX</h1>

<?php if ( $_IS_LOGGED_IN ) require_once $_FILEREF_partial_view_logout_link; ?>

<form style="display: flex; justify-content: center; align-items: center; gap: 0.5rem;" method="POST">
  <label>Login with ID:</label>
  <input type="number" name="login-id">
</form>
