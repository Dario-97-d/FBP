<?php

	// -- Redirect functions --
	
	function REDIRECT( $page_name )
	{
		exit( header('Location: '.$page_name) );
	}