<?php

	// -- Input handling functions --
	
	// -- Results --
	
	function INPUT_failed( $input, $message )
	{
		LOGGER_log_input_fail( $input . ': ' . $message );
		
		return array('failed' => true, 'message' => $message);
	}
	
	function INPUT_handled( $data )
	{
		return array('failed' => false, 'handled' => $data);
	}
	
	// -- Functions --
	
	function INPUT_encrypt_password( $password )
	{
		return password_hash( $password, PASSWORD_BCRYPT );
	}
	
	function INPUT_handle_email( $email )
	{
		$email = trim( $email );
		
		$email_length = strlen( $email );
		
		if ( $email_length < 7 || $email_length > 63 )
		{
			return INPUT_failed( $email, 'Email must be 7 to 63 chars.' );
		}
		
		if ( ! ctype_alnum( str_replace( array('_','-','.','@'), '', $email ) ) )
		{
			return INPUT_failed( $email, 'Email may only have letters, numbers, underscore, hyphen, dot and @.' );
		}
		
		return INPUT_handled( $email );
	}
	
	function INPUT_handle_password( $password )
	{
		$password_length = strlen( $password );
		
		if ( $password_length < 7 || $password_length > 63 )
		{
			return INPUT_failed( '<password>', 'Password must be 7 to 63 chars long.' );
		}
		
		return INPUT_handled( INPUT_encrypt_password( $password ) );
	}
	
	function INPUT_handle_player_name( $name )
	{
		$name = trim( $name );
		
		while ( str_contains( $name, '  ' ) )
		{
			$name = str_replace( '  ', ' ', $name );
		}
		
		$name_length = strlen( $name );
		
		// Check whether length is 7 to 31 chars.
		if ( $name_length  < 7 || $name_length > 31 )
		{
			return INPUT_failed( $name, 'Player name must be 7 to 31 chars long.' );
		}
		
		// Check whether every char is either letter or whitespace.
		if ( ! ctype_alpha( str_replace( ' ', '', $name ) ) )
		{
			return INPUT_failed( $name, 'Player name may only have letters and whitespace.' );
		}
		
		return INPUT_handled( $name );
	}
	
	function INPUT_handle_search_name( $name )
	{
		$name = trim( $name );
		
		if ( strlen( $name ) > 31 )
		{
			return INPUT_failed( $name, 'Search name is too long.' );
		}
		
		if ( ! ctype_alnum( str_replace( array('_','-',' '), '', $name ) ) )
		{
			return INPUT_failed( $name, 'Invalid search name.' );
		}
		
		return INPUT_handled( $name );
	}
	
	function INPUT_handle_team_name( $name )
	{
		$name = trim( $name );
		
		$name_length = strlen( $name );
		
		// -- Check length, safe chars, min 1 letters --
		
		// Check length is 4-16 chars.
		if ( $name_length < 4 || $name_length > 15)
		{
			return INPUT_failed( $name, 'Team name must be 4 to 15 chars long.' );
		}
		
		// Check for unallowed chars.
		if ( ! ctype_alnum( str_replace( array('_','-',' '), '', $name ) ) )
		{
			return INPUT_failed( $name, 'Team name may only have numbers, letters, underscore, hyphen and space.' );
		}
		
		// Check for minimum of 1 letters.
		if ( strlen( str_replace( array('_','-',' ','0','1','2','3','4','5','6','7','8','9'), '', $name ) ) < 1 )
		{
			return INPUT_failed( $name, 'Team name must have at least 1 letter.' );
		}
		
		return INPUT_handled( $name );
	}
	
	function INPUT_handle_text( $text )
	{
		$text = trim( $text );
		
		$text_length = strlen( $text );
		
		// Check limit of chars (1-255)
		
		if ( $text_length < 1 )
		{
			// Text is empty.
			return INPUT_failed( '<text>', 'Text is empty.');
		}
		elseif ( $text_length > 1000 )
		{
			// Text is too long. Max chars: 1000
			return INPUT_failed( '<text>', 'Text must be at most 1000 characters.');
		}
		
		return INPUT_handled( $text );
	}
	
	function INPUT_handle_username( $username )
	{
		$username = trim( $username );
		
		$username_length = strlen( $username );
		
		// -- Check length, safe chars, min 1 letters --
		
		// Check length is 3-15 chars.
		if ( $username_length < 3 || $username_length > 15)
		{
			return INPUT_failed( $username, 'Username must be 3 to 15 chars long.' );
		}
		
		// Check for unallowed chars.
		if ( ! ctype_alnum( str_replace( array('_','-'), '', $username ) ) )
		{
			return INPUT_failed( $username, 'Username may only have letters, numbers, underscore and hyphen.' );
		}
		
		// Check for minimum of 1 letters.
		if ( strlen( str_replace( array('_','-',' ','0','1','2','3','4','5','6','7','8','9'), '', $username ) ) < 1 )
		{
			return INPUT_failed( $username, 'Username must have at least 1 letter.' );
		}
		
		return INPUT_handled( $username );
	}
	
	function INPUT_is_id_valid( $id )
	{
		$is_valid = ctype_digit( strval( $id ) );
		
		if ( $is_valid ) return true;
		
		LOGGER_log_input_fail( 'ID '.$id.' is not valid.' );
	}
	
	function INPUT_is_valid_staff_role( $staff_role )
	{
		$is_valid = in_array( $staff_role, array( 'Admin', 'Boss', 'Captain', 'Dweller', 'Element', 'Free' ) );
		
		if ( $is_valid ) return true;
		
		LOGGER_log_input_fail( $staff_role.' is not a valid staff role.' );
	}