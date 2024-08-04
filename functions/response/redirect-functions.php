<?php

	// -- Redirect functions --
	
	function REDIRECT( $page_name )
	{
		exit( header('Location: '.$page_name) );
	}
	
	function REDIRECT_current()
	{
		global $_CURRENT_PAGE_NAME;
		
		exit( header('Location: '.$_CURRENT_PAGE_NAME) );
	}