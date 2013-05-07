<?php

namespace Core\Support\Facades;

use Core\Support\Facade;

class Arr extends Facade
{
	public static function getFacadeAccessor() { return 'underscore'; }
}