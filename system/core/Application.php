<?php

namespace Core;

use Core\Http\Request;
use Core\Http\Response;
use Core\Support\Facade;
use Core\Utilities\Config;
use Core\Database\Database;
use Core\Routing\RouteGenerator;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

class Application extends \Pimple
{
	public function __construct()
	{
		parent::__construct();

		Config::setConfigDirectory(APP_PATH.'config'.DS);

		$app = $this;

		$app['router'] = $app->share(function($app) {
			return new RouteGenerator($app, new \Bistro\Router\Router);
		});

		$app['request'] = $app->share(function($app) {
			return Request::createFromGlobals();
		});

		$app['response'] = $app->share(function($app) {
			return new Response();
		});

		$app['database'] = function($app) {
			return new Database(Config::get('database.credentials'));
		};
	}

	public function bind($name, $callback)
	{
		if (is_callable($callback)) {
			$this[$name] = $callback($this);
		}
	}

	public function get($name)
	{
		return $this[$name];
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

	public function routeRequest($params = null)
	{
		require APP_PATH.'routes'.EXT;

		$route = $this['router']->match($this['request']->server->get('REQUEST_METHOD'), $this['request']->getPathInfo());

		$controller = new $route['controller']($this, $route);

		$response = $controller->before();
        $response = (is_null($response)) ? $controller->execute() : $response;
        $controller->after();

        return $response;
	}
}