<?php

use Core\Http\Request;
use Core\Http\Response;
use Core\Routing\Router;
use Core\Support\Facade;
use Core\Database\Database;

$app = new Pimple();

$app['router'] = $app->share(function() {
	return new Router();
});

$app['request'] = $app->share(function($c) {
	return Request::createFromGlobals();
});

$app['response'] = $app->share(function($c) {
	return new Response();
});

$app['database'] = function($co) {
	return new Database(Config::get('database.credentials'));
};

Facade::setApplicationInstance($app);