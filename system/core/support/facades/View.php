<?php

namespace Core\Support\Facades;

use Core\Support\Facade;

class View extends Facade
{
	public static function getFacadeAccessor() { return 'view'; }
}