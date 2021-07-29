<?php

	/*ROUTES EVERYTHING*/

	require_once 'config/env.php';
	require_once 'core/Bootstrap.php';
	require_once 'functions/core.php';
	

	/*THE BEST AUTOLOADER! IN THE WORLD*/
	spl_autoload_register(function($class_name){  
		/**CHANGE DIR */
		$file = null;
		$invalidChars = array(
        '.', '\\', '/', ':', '*', '?', '"', '<', '>', "'", '|'
		);
		$class_name = ucfirst(str_replace($invalidChars, '', $class_name));
		$extension_prefix = '.php';
		$basePath = getcwd();

		_returnAndRequire($basePath.DS.'core' , $class_name);
		_returnAndRequire($basePath.DS.'controllers' , $class_name);
		_returnAndRequire($basePath.DS.'models' , $class_name);
	});


	$bootstrap = new Bootstrap();
	
