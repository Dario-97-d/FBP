<?php

	// -- Dialog Functions --
	
	$_DIALOG_MESSAGES = [];
	
	function DIALOG_add_fail( $category, $message )
	{
		DIALOG_add_message( $category.' fail', $message );
	}
	
	function DIALOG_add_input_fail( $message )
	{
		DIALOG_add_fail( 'input', $message );
	}
	
	function DIALOG_add_login_fail( $message )
	{
		DIALOG_add_fail( 'login', $message );
	}
	
	function DIALOG_add_mail_fail( $message )
	{
		DIALOG_add_fail( 'mail', $message );
	}
	
	function DIALOG_add_mates_fail( $message )
	{
		DIALOG_add_fail( 'mates', $message );
	}
	
	function DIALOG_add_message( $title, $message )
	{
		global  $_DIALOG_MESSAGES;
		
		$_DIALOG_MESSAGES[] = [ $title => $message ];
	}
	
	function DIALOG_add_player_fail( $message )
	{
		DIALOG_add_fail( 'player', $message );
	}
	
	function DIALOG_add_register_fail( $message )
	{
		DIALOG_add_fail( 'register', $message );
	}
	
	function DIALOG_add_result( $result )
	{
		DIALOG_add_message( $result['status'], $result['message'] );
	}
	
	function DIALOG_add_team_fail( $message )
	{
		DIALOG_add_fail( 'team', $message );
	}
	
	function DIALOG_add_team_management_fail( $message )
	{
		DIALOG_add_fail( 'team management', $message );
	}
	
	function DIALOG_all()
	{
		global $_DIALOG_MESSAGES;
		
		$script = '';
		
		$script_open = '<script>';
		$script_close = '</script>';
		
		foreach ( $_DIALOG_MESSAGES as $message )
		{
			foreach ( $message as $key => $value )
			{
				$script .= "\n" . "alert('" . strtoupper( $key ) . ': ' . $value . "');" . "\n";
			}
		}
		
		$script = $script_open . $script . $script_close;
		
		return $script;
	}