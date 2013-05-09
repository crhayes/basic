<?php

namespace App\Controllers;

class ErrorController extends \Controller
{
	public function missingMethod()
	{
		echo '404';
	}
}