<?php

namespace Core\View;

class InvalidViewProviderException extends \Exception {}

class View extends \Symfony\Component\HttpFoundation\Response
{
	private $app;

	private $viewPath;

	private $viewProvider = 'scenic';

	private $viewName;

	private $data = array();

	public function __construct($viewName, $data = array())
	{
		$this->viewPath = APP_PATH.'views'.DS;

		$this->viewName = $viewName;

		$this->data = $data;
	}

	public function make($viewName, $data = array())
	{
		return new View($viewName, $data);
	}

	public function with($key, $value)
	{
		$this->data[$key] = $value;

		return $this;
	}

	public function setViewProvider($viewProvider)
	{
		$this->viewProvider = $viewProvider;

		return $this;
	}

	public function getViewProvider()
	{
		switch(strtolower($this->viewProvider)) {
			case 'twig':
				return new Providers\TwigViewProvider();
			case 'scenic':
				return new Providers\ScenicViewProvider();
			default:
				throw new InvalidViewProviderException("'$this->viewProvider' is not a valid view provider");
		}
	}

	public function send()
	{
		$provider = $this->getViewProvider();

		$provider->initialize();

		return $provider->render($this->viewName, $this->data);
	}
}