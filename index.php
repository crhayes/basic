<?php

error_reporting(-1);
ini_set('display_errors', 0);

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
// Create a new application instance.
// --------------------------------------------------------------
$app = new Core\Application();

// --------------------------------------------------------------
// Register class aliases
// --------------------------------------------------------------
$app->registerAliases();

// --------------------------------------------------------------
// Register error handler
// --------------------------------------------------------------
$app->registerErrorHandler();

// --------------------------------------------------------------
// Set the application instance for the facade support class
// --------------------------------------------------------------
Core\Support\Facade::setApplicationInstance($app);

$response = $app->routeRequest();

$app['response']->setContent($response)->send();