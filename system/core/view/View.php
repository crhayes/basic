<?php

namespace Core\View;

class View extends \Symfony\Component\HttpFoundation\Response
{
	private $app;

	private $twig;

	private $view;

	private $data = array();

	public function __construct($app)
	{
		$this->app = $app;

		/*
		$loader = new \Twig_Loader_Filesystem(APP_PATH.'views');
		$this->twig = new \Twig_Environment($loader, array(
		    'cache' => APP_PATH.'storage/views',
		));
		*/
		
	}

	public function with($key, $value)
	{
		$this->data[$key] = $value;

		return $this;
	}

	public function make($view, $data = array())
	{
		$this->view = str_replace('.', '/', $view).EXT;

		$this->data = $data;

		return $this;
	}

	public function send()
	{
		//echo $this->twig->render('index.php', array('name' => 'Fabien'));
		//
		$view = \Core\View\SwiftTemplate::make('index', array())->send();
	}
}