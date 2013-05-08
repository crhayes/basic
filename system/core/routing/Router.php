<?php

namespace Core\Routing;

class Router extends \Bistro\Router\Router
{
	public function get($name, $route, $callback)
	{
		list($controller, $action) = explode('@', $callback);

		parent::get($name, $route)->defaults(array(
		    'controller' => $controller,
		    'action' => $action
		));
	}

	public function post($name, $route, $callback)
	{
		list($controller, $action) = explode('@', $callback);

		parent::post($name, $route)->defaults(array(
		    'controller' => $controller,
		    'action' => $action
		));
	}

	public function put($name, $route, $callback)
	{
		list($controller, $action) = explode('@', $callback);

		parent::put($name, $route)->defaults(array(
		    'controller' => $controller,
		    'action' => $action
		));
	}

	public function delete($name, $route, $callback)
	{
		list($controller, $action) = explode('@', $callback);

		parent::delete($name, $route)->defaults(array(
		    'controller' => $controller,
		    'action' => $action
		));
	}
}