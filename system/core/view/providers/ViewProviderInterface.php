<?php

namespace Core\View\Providers;

interface ViewProviderInterface
{
	public function initialize();

	public function render($view, $data);
}