<?php

	// -- URL functions --
	
	function URL_get_page_name()
	{
		$exploded_on_slash = explode( '/', $_SERVER['REQUEST_URI'] );
		
		$page_part = $exploded_on_slash[2];
		
		if ( strpos( $page_part, '?' ) !== false )
		{
			$page_part = strstr( $page_part, '?', true );
		}
		
		return $page_part;
	}