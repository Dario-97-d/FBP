<?php

	// -- Update procedures --
	/*
	 * This script allows for creating procedures if these aren't present in the database.
	 * Which procedures are created may be defined with $update_all = false and $update_which[i] = 1.
	*/
	
	$update_all = true;
	
	// Folder structure of sql stored procedures.
	$update_which = array(
		'mates' => array(
			'accept_request'     => 0,
			'send_request'       => 0
		),
		'team' => array(
			'accept_application' => 0,
			'accept_invite'      => 0,
			'apply'              => 0,
			'create'             => 0,
			'eliminate'          => 0,
			'expel_player'       => 0,
			'player_leave'       => 0
		),
		'register_player'        => 0,
		'send_mail'              => 0
	);

	// Holds the procedures to be added to the final script.
	$procedures = array();
	
	// Adds content of file to the procedures array.
	function add_file_content( $path )
	{
		global $procedures;
		
		// Get content of stored procedure file.
		$current_procedure = file_get_contents( __DIR__ . '/stored-procedures/' . $path );
		
		// Remove phpmyadmin code.
		$current_procedure = str_replace(
			['DELIMITER ;', 'DELIMITER //'],
			'',
			$current_procedure );
		
		// Replace delimiter.
		$current_procedure = str_replace(
			'END //',
			'END;',
			$current_procedure );
		
		$procedures[] = $current_procedure;
	}
	
	// Iterate through all files.
	foreach ( $update_which as $each => $value )
	{
		// Check whether the current value is a file name or an array of file names (folder).
		if ( is_array( $value ) )
		{
			// Iterate through all files in folder.
			foreach ( $value as $sub_each => $sub_value )
			{
				// If this file is set to be created, add its content to the final procedures array.
				if ( $update_all || $sub_value )
				{
					// Add file content - replace team -> teams where applicable.
					add_file_content( $each.'/'.'sp_'.str_replace( 'team', 'teams', $each ).'_'.$sub_each.'.sql' );
				}
			}
		}
		else
		{
			// If this file is set to be created, add its content to the final procedures array.
			if ( $update_all || $value )
			{
				add_file_content( 'sp_'.$each.'.sql' );
			}
		}
	}
	
	// -- Run SQL Script --
	if ( isset( $_POST['run-script'] ) )
	{
		$conn = mysqli_connect( 'localhost', 'fbp', '/iZxET)I!0nSM7Ue', 'fbp' );
		
		// Check connection.
		if ( ! $conn )
		{
			$output = 'MySQL connection failed. Error no.: '.mysqli_connect_errno();
		}
		else
		{
			$output = '<table>';
			
			// Add result of each procedure creation to the output string.
			foreach ( $procedures as $index => $procedure )
			{
				// Create procedure.
				$result = mysqli_query( $conn, $procedure ) or mysqli_error( $conn );
				
				// Add result to the output string.
				$output .= '<h4>'.($index + 1).': '.$result.'</h4>';
			}
			
			$output .= '</table>';
		}
	}
	else
	{
		// Initial standard behavior - script not run.
		$output = '<h4>Check procedures and click Run.</h4>';
		$output .= '<form method="POST"><input type="submit" name="run-script" value="Run SQL"></form>';
	}
	
	echo '<h2>Output</h2>';
	echo $output;
	
	echo '<h2>SQL script</h2>';
	
	// Format procedures for HTML.
	$i = 0;
	foreach ( $procedures as $proc )
	{
		$i++;
		echo '<h4>-- Procedure '.$i.' --</h4>';
		echo str_replace( "\r\n", '<br />', $proc );
	}