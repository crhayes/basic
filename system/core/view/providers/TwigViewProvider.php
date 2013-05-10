<?php

namespace Core\View\Providers;

class TwigViewProvider implements ViewProviderInterface
{
	private $twig;

	public function initialize()
	{
		$loader = new \Twig_Loader_Filesystem(APP_PATH.'views/');
		$this->twig = new \Twig_Environment($loader, array(
		    'cache' => APP_PATH.'storage/views',
		)); 
	}

	public function render($view, $data)
	{
		return $this->twig->render($view.EXT, $data);
	}
}