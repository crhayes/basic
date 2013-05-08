<?php

namespace Core;

use Core\Http\Request;
use Core\Http\Response;
use Core\Routing\Router;
use Core\Support\Facade;
use Core\Utilities\Config;
use Core\Database\Database;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;



class Application extends \Pimple
{
	public function __construct()
	{
		parent::__construct();

		Config::setConfigDirectory(APP_PATH.'config'.DS);

		$app = $this;

		$app['router'] = $app->share(function($c) {
			return new Router();
		});

		$app['request'] = $app->share(function($c) {
			return Request::createFromGlobals();
		});

		$app['response'] = $app->share(function($c) {
			return new Response();
		});

		$app['database'] = function($c) {
			return new Database(Config::get('database.credentials'));
		};
	}

	public function registerAliases()
	{
		$aliases = Config::get('application.aliases');

		foreach ($aliases as $alias => $class) {
			class_alias($class, $alias);
		}
	}

	public function registerErrorHandler()
	{
		$whoops     = new \Whoops\Run;
		$whoopsHandler = new PrettyPageHandler;

		$whoopsHandler->setPageTitle("An Error Occurred");

		$whoops->pushHandler($whoopsHandler);

		$whoops->register();
	}

	public function routeRequest()
	{
		require APP_PATH.'routes'.EXT;

		$params = $this['router']->match($this['request']->server->get('REQUEST_METHOD'), $this['request']->getPathInfo());
		
		return call_user_func_array(array($params['controller'], $params['action']), explode('/', $params['params']));
	}
}