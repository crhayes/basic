<?php

namespace Core\View\Providers;

class ScenicViewProvider implements ViewProviderInterface
{
	private $scenic;

	public function initialize()
	{
		 $this->scenic = new \Scenic\View(APP_PATH.'views/');
	}

	public function render($view, $data)
	{
		return $this->scenic->render($view, $data);
	}
}