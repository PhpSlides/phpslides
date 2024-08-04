<?php

use PhpSlides\Http\Api;
use App\Controllers\UserController;

Api::v1()->route('/user', UserController::class);