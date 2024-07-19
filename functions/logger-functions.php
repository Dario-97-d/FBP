<?php

	// -- Logger Functions --
	
	function LOGGER_delete_old_records( $file_name )
	{
		// Return if file doesn't exist.
		if ( ! file_exists( $file_name ) ) return true;
		
		$file_content = file_get_contents( $file_name );
		
		$lines = explode( "\n", $file_content );
		
		// 86400 seconds == 24 hours.
		$time_limit = time() - 86400;
		
		$limit_index = 0;
		
		foreach ( $lines as $index => $line )
		{
			if ( strtotime( substr( $line, 1, 20 ) ) > $time_limit )
			{
				$limit_index = $index;
				break;
			}
		}
		
		$final_content = implode( "\n", array_slice( $lines, $limit_index ) );
		
		file_put_contents( $file_name, $final_content );
	}
	
	function LOGGER_get_custom_stack_trace()
	{
		// -- Get string like: "page-name: FEATURE_function() -> SERVICE_function()" --
		
		global $_CURRENT_PAGE_NAME;
		
		// Get backtrace without args.
		$backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
		
		// Prepare array for further implode().
		$functions_stack = array();
		
		// Iterate backwards over the backtrace entries.
		foreach ( array_reverse( $backtrace ) as $entry )
		{
			// Ensure function name is set in the current entry.
			if ( isset( $entry['function'] ) )
			{
				$function_name = $entry['function'];
				
				// Exlude 'LOGGER' functions. These should be the last ones.
				if ( strpos( $function_name, 'LOGGER' ) === 0 ) break;
				
				// Add function name to the output array.
				array_push( $functions_stack, $function_name.'()' );
			}
		}
		
		$custom_stack = $_CURRENT_PAGE_NAME . ': ' . implode( ' -> ', $functions_stack );
		
		return $custom_stack;
	}
	
	function LOGGER_log_error( $category, $message )
	{
		LOGGER_log_to_file( 'Error', $category, $message );
	}
	
	function LOGGER_log_fail( $category, $message )
	{
		LOGGER_log_to_file( 'Fail', $category, $message );
	}
	
	function LOGGER_log_input_fail( $message )
	{
		LOGGER_log_fail( 'input', $message );
	}
	
	function LOGGER_log_mysql_error( $message )
	{
		return LOGGER_log_error( 'mysql', $message );
	}
	
	function LOGGER_log_to_file( $level, $category, $message )
	{
		// -- Log to generic file and to categoric file --
		
		$path = __DIR__ . '/../logs/';
		
		$generic_logs_file = $path . 'logs.txt';
		$categoric_logs_file = $path . $category .'-logs.txt';
		
		$date_time = date( '[Y-m-d H:i:s]' );
		
		$stack_trace = LOGGER_get_custom_stack_trace();
		
		// Create user session string.
		$user = isset( $_SESSION['id'] ) ? 'Session User ID: '.$_SESSION['id'] : 'Unlogged User Session';
		
		// Remove new lines from message so as to log one line.
		$message = preg_replace( '/[\r\n]+/', ' ', $message );
		
		$log_line = $date_time . ' ' . $category . ' ' . $level . ' - ' . $stack_trace . ' - ' . $message . ' (' . $user . ')' . "\n";
		
		// LOGGER_delete_old_records( $generic_logs_file );
		// LOGGER_delete_old_records( $categoric_logs_file );
		
		file_put_contents( $generic_logs_file, $log_line, FILE_APPEND );
		file_put_contents( $categoric_logs_file, $log_line, FILE_APPEND );
	}