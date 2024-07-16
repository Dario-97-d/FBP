<?php

	// -- RESULT functions --
	// Used as function result in Feature and SQL functions.
	
	function RESULT( $status, $message, $data = null )
	{
		return array(
			'status' => $status,
			'message' => $message,
			'data' => $data
		);
	}
	
	function RESULT_error( $message = null )
	{
		return RESULT( 'error', $message ?? '' );
	}
	
	function RESULT_fail( $message = null )
	{
		return RESULT( 'fail', $message );
	}
	
	function RESULT_generic_fail()
	{
		return RESULT( 'fail', 'something went wrong' );
	}
	
	function RESULT_get_data( $result )
	{
		return $result['data'];
	}
	
	function RESULT_get_message( $result )
	{
		return $result['message'];
	}
	
	function RESULT_is_error( $result )
	{
		return $result['status'] == 'error';
	}
	
	function RESULT_is_fail( $result )
	{
		return $result['status'] == 'fail';
	}
	
	function RESULT_is_success( $result )
	{
		return $result['status'] == 'success';
	}
	
	function RESULT_success( $data = null, $message = null )
	{
		return RESULT( 'success', $message, $data );
	}