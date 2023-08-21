<?php
spl_autoload_register(function ($component) {
	$componentPath = './components/' . $component . '.php';
	if (file_exists($componentPath)) {
		require $componentPath;
	}
	// echo $componentPath;
});

// enather way:
// =======================================
// spl_autoload_register(function ($component) {
// 	// базовая директория для компонентов
// 	$base_dir = __DIR__ . '/components/';

// 	// добавляем .php к имени класса
// 	$file = $base_dir . $component . '.php';
// $base_dir = __DIR__ . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR;

// 	// если файл существует, то подключаем его
// 	if (file_exists($file)) {
// 		require $file;
// 	}
// 	echo $file;
// });
