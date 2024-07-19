<?php

	// -- SQL functions --
	
	// Global connection variable.
	$_CONN;
	
	// Require other functions.
	require_once $_FILEREF_logger_functions;
	require_once $_FILEREF_result_functions;
	
	// -- Functions --
	
	/*
	* -- Connect and Close --
	* -- SQL result one-liners --
	* -- Short-hand functions for db operations --
	* -- DB access point --
	*/
	
	// -- Connect and Close --
	
	function SQL_close()
	{
		global $_CONN;
		
		if ( $_CONN ) mysqli_close( $_CONN );
	}
	
	function SQL_connect()
	{
		global $_CONN;
		
		$_CONN = mysqli_connect( 'localhost', 'fbp', '/iZxET)I!0nSM7Ue', 'fbp' );
		
		if ( ! $_CONN )
		{
			LOGGER_log_mysql_error( 'MySQL connection failed. Error no.: '.mysqli_connect_errno() );
		}
		
		return $_CONN;
	}
	
	// -- SQL result one-liners --
	
	function SQL_fetch_all_assoc( $sql_result )
	{
		return mysqli_fetch_all( $sql_result, MYSQLI_ASSOC );
	}
	
	function SQL_fetch_row_assoc( $sql_result )
	{
		return mysqli_fetch_assoc( $sql_result );
	}
	
	function SQL_fetch_value( $sql_result )
	{
		return mysqli_fetch_row( $sql_result )[0];
	}
	
	function SQL_is_empty( $sql_result )
	{
		return mysqli_num_rows( $sql_result ) == 0;
	}
	
	// -- Short-hand functions for db operations --
	
	function SQL_prep_bool_or_null( $query, $params )
	{
		$get_bool = SQL_prep_stmt_result( $query, $params );
		
		return RESULT_is_success( $get_bool ) ? ! SQL_is_empty( RESULT_get_data( $get_bool ) ) : null;
	}
	
	function SQL_prep_get_multi( $query, $params = null )
	{
		$get_multi = SQL_prep_stmt_result( $query, $params );
		
		if ( RESULT_is_success( $get_multi ) )
		{
			$sql_result = RESULT_get_data( $get_multi );
			
			if ( SQL_is_empty( $sql_result ) )
			{
				return true;
			}
			else
			{
				return SQL_fetch_all_assoc( $sql_result );
			}
		}
		
		return false;
	}
	
	function SQL_prep_get_row( $query, $params )
	{
		$get_row = SQL_prep_stmt_one( $query, $params );
		
		return RESULT_is_success( $get_row ) ? SQL_fetch_row_assoc( RESULT_get_data( $get_row ) ) : false;
	}
	
	function SQL_prep_get_value( $query, $params )
	{
		$get_value = SQL_prep_stmt_one( $query, $params );
		
		return RESULT_is_success( $get_value ) ? SQL_fetch_value( RESULT_get_data( $get_value ) ) : false;
	}
	
	function SQL_prep_procedure( $query, $params )
	{
		$call_procedure = SQL_prep_stmt_result( $query, $params );
		
		if ( RESULT_is_success( $call_procedure ) )
		{
			$procedure_output = SQL_fetch_value( RESULT_get_data( $call_procedure ) );
			
			if ( $procedure_output != 'success' )
			{
				return RESULT_fail( $procedure_output );
			}
		}
		
		return $call_procedure;
	}
	
	function SQL_prep_stmt_one( $query, $params )
	{
		$prep_stmt = SQL_prep_stmt_result( $query, $params );
		
		// Filter successful result to ensure it's one row.
		if ( RESULT_is_success( $prep_stmt ) )
		{
			$row_count = RESULT_get_message( $prep_stmt );
			if ( $row_count != 1 )
			{
				LOGGER_log_mysql_error( 'SQL result expected to be 1 row, it\'s '.$row_count.' rows instead. $query: '.$query.', $params: ('.implode( ', ', $params ).')' );
				return RESULT_generic_fail();
			}
		}
		
		return $prep_stmt;
	}
	
	// -- DB access point --
	// This is the function operating directly on the database.
	function SQL_prep_stmt_result( $query, $params = [] )
	{
		global $_CONN;
		
		try
		{
			// Prepare statement.
			$stmt = mysqli_prepare( $_CONN, $query );
			
			// Bind parameters if there are any.
			if ( ! empty( $params ) )
			{
				$types = '';
				
				// Determine parameter types.
				foreach ( $params as $param )
				{
					$types .= is_int( $param ) ? 'i' : ( is_float( $param ) ? 'd' : 's' );
				}
				
				// Bind parameters.
				mysqli_stmt_bind_param( $stmt, $types, ...$params );
			}
			
			// Execute statement.
			mysqli_stmt_execute( $stmt );
			
			// -- Handle Result --
			
			// Get first word of query.
			$query_type = strtoupper( substr( $query, 0, 6 ) );
			
			// Return according to the query type.
			switch ( $query_type )
			{
				// Stored procedures.
				case 'CALL S':
					$procedure_output = mysqli_stmt_get_result( $stmt );
					
					mysqli_stmt_close( $stmt );
					return RESULT_success( $procedure_output );
				
				case 'SELECT':
					$sql_result = mysqli_stmt_get_result( $stmt );
					$row_count  = mysqli_num_rows       ( $sql_result );
					
					mysqli_stmt_close( $stmt );
					return RESULT_success( $sql_result, $row_count );
				
				case 'INSERT':
				case 'UPDATE':
				case 'DELETE':
					$affected_rows = mysqli_stmt_affected_rows( $stmt );
					
					mysqli_stmt_close( $stmt );
					return RESULT_success( null, $affected_rows );
				
				default:
					// -- Unexpected query type --
					LOGGER_log_mysql_error( 'Unexpected query type. Expected types: CALL s, SELECT, INSERT, UPDATE, DELETE. $query_type: '.$query_type.', $query: '.$query );
					mysqli_stmt_close( $stmt );
					return RESULT_error();
			}
		}
		catch (Exception $e)
		{
			LOGGER_log_mysql_error( 'Exception at SQL_prep_stmt_result(). $query: '.$query.', $params: ('.implode( ', ', $params ).'), $e->getMessage(): '.$e->getMessage() );
			return RESULT_error();
		}
	}