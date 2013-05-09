<?php

namespace Core\Routing;

class RouteGenerator
{
	private $app;

	private $router;

	public function __construct($app, $router)
	{
		$this->app = $app;

		$this->router = $router;
	}

	public function get($name, $route, $callback)
	{
		list($controller, $action) = explode('@', $callback);

		$this->createRoute('get', $name, $route, $controller, $action);
	}

	public function post($name, $route, $callback)
	{
		list($controller, $action) = explode('@', $callback);

		$this->createRoute('post', $name, $route, $controller, $action);
	}

	public function put($name, $route, $callback)
	{
		list($controller, $action) = explode('@', $callback);

		$this->createRoute('put', $name, $route, $controller, $action);
	}

	public function delete($name, $route, $callback)
	{
		list($controller, $action) = explode('@', $callback);

		$this->createRoute('delete', $name, $route, $controller, $action);
	}

	public function controller($name, $route, $controller)
	{
		$this->createRoute('add', $name, $route.'/:action?/.*:params?', $controller, 'index', 'controller');
	}

	private function createRoute($method, $name, $route, $controller, $action, $type = 'method')
	{
		$this->router->{$method}($name, $route)->defaults(array(
		    'controller' => $controller,
		    'action' => $action,
		    '_type' => $type,
		    '_method' => $this->app['request']->server->get('REQUEST_METHOD')
		));
	}

	public function __call($name, $arguments)
	{
		$this->createRoute('add', $name, '.*', 'Core\\Controller', 'missingMethod');

		return call_user_func_array(array($this->router, $name), $arguments);
	}
}