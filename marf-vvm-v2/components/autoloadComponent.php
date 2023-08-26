<?php
spl_autoload_register(function ($component) {
	$componentPath = './components/' . $component . '.php';
	if (file_exists($componentPath)) {
		require $componentPath;
	}
	// echo $componentPath;
});
