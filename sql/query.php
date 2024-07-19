<?php

	if ( isset( $_POST['query'] ) )
	{
		$conn = mysqli_connect( 'localhost', 'fbp', '/iZxET)I!0nSM7Ue', 'fbp' );
		
		// Check connection.
		if ( ! $conn )
		{
			$_output = 'MySQL connection failed. Error no.: '.mysqli_connect_errno();
		}
		else
		{
			$result = mysqli_query( $conn, $_POST['query'] ) or die( mysqli_error( $conn ) );
			
			$_output = '<table>';
			while ( $row = mysqli_fetch_assoc( $result ) )
			{
				$_output .= '<tr>';
				foreach ( $row as $field => $value )
				{
					$_output .= "<th>$field</th><td>$value</td>";
				}
				$_output .= '</tr>';
			}
			$_output .= '</table>';
		}
	}
	else $_output = 'Do something.';

?>

<form method="POST" onsubmit="return confirm(document.getElementById('input-query').value + ' ?')">
	<input type="text" id="input-query" name="query" />
	<input type="submit">
</form>

<p><?= $_output ?></p>