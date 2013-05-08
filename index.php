<?php

// --------------------------------------------------------------
// Create aliases for ease of use.
// --------------------------------------------------------------
define('DS', DIRECTORY_SEPARATOR);
define('EXT', '.php');

// --------------------------------------------------------------
// Define useful app constants.
// --------------------------------------------------------------
define('DOC_ROOT', realpath(dirname(__FILE__)).DS);
define('SYS_PATH', DOC_ROOT.'system'.DS);
define('APP_PATH', DOC_ROOT.'app'.DS);
define('LIB_PATH', DOC_ROOT.'libraries'.DS);
define('BASE_PATH', substr(DOC_ROOT, strlen($_SERVER['DOCUMENT_ROOT'])));

// --------------------------------------------------------------
// Load the autoloader and helper functions.
// --------------------------------------------------------------
require SYS_PATH.'vendor/autoload'.EXT;
require SYS_PATH.'helpers'.EXT;

// --------------------------------------------------------------
// Register class aliases
// --------------------------------------------------------------
class_alias('Core\Utilities\Arr', 'Arr');
class_alias('Core\Utilities\Config', 'Config');
class_alias('Core\Support\Facades\Database', 'Database');

Config::setConfigDirectory(APP_PATH.'config'.DS);

// --------------------------------------------------------------
// Bootstrap the application.
// --------------------------------------------------------------
require APP_PATH.'bootstrap'.EXT;
require APP_PATH.'routes'.EXT;

$users = Database::query('SELECT * FROM user');

foreach ($users as $user) {
	echo $user->email . '<br>';
}

$method = $_SERVER['REQUEST_METHOD'];
$uri = isset($_SEVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

$params = $app['router']->match($method, $uri);
 
$app['response']->send();