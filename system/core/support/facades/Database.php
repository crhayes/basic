<?php

namespace Core\Support\Facades;

use Core\Support\Facade;

class Database extends Facade
{
	public static function getFacadeAccessor() { return 'database'; }
}