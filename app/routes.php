<?php

Route::get('home', '/', 'App\\Controllers\\HomeController@getIndex');

Route::controller('about', '/admin', 'App\\Controllers\\AboutController');
