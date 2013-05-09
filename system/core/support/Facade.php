<?php

namespace Core\Support;

class Facade
{
	private static $app;

	public static function setApplicationInstance($app)
	{
		self::$app = $app;
	}

	public static function __callStatic($method, $arguments)
	{		
		$class = (($class = static::getFacadeAccessor()) == 'app') 
			? array(self::$app, $method) 
			: array(self::$app[$class], $method);

		return call_user_func_array($class, $arguments);
	}
}