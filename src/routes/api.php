<?php

use PhpSlides\Http\Api;
use App\Controllers\UserController;

Api::v1()->route('/user', 'UserController@show');
Api::v2()
	->define('/user/', 'UserController')
	->route('/show/{id}', '@show')
	->route('/{id}', '@index');
