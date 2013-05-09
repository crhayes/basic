<?php

namespace App\Controllers;

class AboutController extends \Controller
{
	public function getIndex()
	{
		echo 'this is the about index';
	}
	
	public function getCompany($company = 'Coca Cola', $is = null)
	{
		?>
		<html>
		<head>
			<title></title>
		</head>
		<body>
			<form method="post">
				<button type="submit">Submit</button>
			</form>
		</body>
		</html>
		<?php
	}

	public function postCompany()
	{
		echo 'form submitted';
	}
}