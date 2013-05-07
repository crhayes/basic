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
		$class = static::getFacadeAccessor();

		return call_user_func_array(array(self::$app[$class], $method), $arguments);
	}
}