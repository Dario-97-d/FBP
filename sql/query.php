<?php

	if ( isset( $_POST['query'] ) )
	{
		$conn = mysqli_connect( 'localhost', 'fbp', '/iZxET)I!0nSM7Ue', 'fbp' );
		
		// Check connection.
		if ( ! $conn )
		{
			$result = 'MySQL connection failed. Error no.: '.mysqli_connect_errno();
		}
		else
		{
			$query = $_POST['query'];
			
			$result = mysqli_query( $conn, $query ) or die( mysqli_error( $conn ) );
		}
	}
	else $result = 'Do something.';

?>

<form method="POST" onsubmit="return confirm(document.getElementById('input-query').value + ' ?')">
	<input type="text" id="input-query" name="query" />
	<input type="submit">
</form>

<p><?= $result ?></p>