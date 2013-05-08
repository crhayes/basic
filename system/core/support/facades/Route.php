<?php

namespace Core\Support\Facades;

use Core\Support\Facade;

class Route extends Facade
{
	public static function getFacadeAccessor() { return 'router'; }
}