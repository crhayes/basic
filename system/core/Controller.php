<?php

namespace Core;

class Controller
{
	private $app;

	private $controller;

	private $action;

	private $params;

	public function __construct($app, $route)
	{
		$this->app = $app;

		extract($route);

		$this->controller = $controller;
		$this->action = $this->formatAction($action, $_type, $_method);
		$this->params = (isset($params) && ! empty($params)) ? explode('/', $params) : array();

		return $this;
	}

	private function formatAction($action, $type, $method)
	{
		if ($type == 'controller') {
			$action = strtolower($method).ucfirst($action);
		}

		return $action;
	}

	public function before() {}
	
	public function execute()
	{
		return call_user_func_array(array($this, $this->action), $this->params);
	}

	public function after() {}

	public function missingMethod()
	{
		return '404';
	}

	public function __call($name, $arguments)
	{
		return $this->missingMethod();
	}
}