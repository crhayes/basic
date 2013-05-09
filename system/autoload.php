<?php

require SYS_PATH.'vendor/autoload'.EXT;

spl_autoload_register(function ($class) {
	$filePos = strrpos($class, '\\');
	$filePath = strtolower(str_replace('\\', '/', substr($class, 0, $filePos))).DS;
	$file = substr($class, $filePos + 1).EXT;

    $classPath = $filePath . $file;

    file_exists($classPath) ? require $classPath : null;
});