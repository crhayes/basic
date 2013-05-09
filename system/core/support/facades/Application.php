<?php

namespace Core\Support\Facades;

use Core\Support\Facade;

class Application extends Facade
{
	public static function getFacadeAccessor() { return 'app'; }
}