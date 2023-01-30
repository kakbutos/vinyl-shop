<?php



function reqister($class, $prefix, $base_dir){
	spl_autoload($class, $prefix, $base_dir);
}
spl_autoload_register(function ($class) {

	// project-specific namespace prefix
	$prefix = 'Eshop\\';

	// base directory for the namespace prefix


	// does the class use the namespace prefix?
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		return;
	}

	// get the relative class name
	$relative_class = substr($class, $len);

	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file =  str_replace('\\', '/', $relative_class) . '.php';

	$base_dir = $_SERVER['DOCUMENT_ROOT'] . '/../src/';


	if (file_exists($base_dir .$file)) {
		require $base_dir .$file;

	}else {
		$base_dir = $_SERVER['DOCUMENT_ROOT'] . '/../';
		if (file_exists($base_dir .$file)){

			require $base_dir .$file;
		}
	}


});


