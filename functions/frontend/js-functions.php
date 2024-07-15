<?php

	$_JS_paths = [];
	
	function JS_add_script( $path )
	{
		global $_JS_paths;
		
		if ( ! in_array( $path, $_JS_paths ) )
		{
			$_JS_paths[] = $path;
		}
	}
	
	function JS_render_scripts()
	{
		global $_JS_paths;
		
		$all_scripts = '';
		
		foreach ( $_JS_paths as $js_path )
		{
			$all_scripts .= '<script src="'.htmlspecialchars( $js_path, ENT_QUOTES, 'UTF-8' ).'"></script>';
		}
		
		return $all_scripts;
	}