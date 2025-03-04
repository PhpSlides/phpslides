<?php

use PhpSlides\Router\Route;
use PhpSlides\Core\Foundation\Render;
use PhpSlides\Core\Loader\FileLoader;

include __DIR__ . '/../../vendor/autoload.php';

/**
 * -----------------------------------------------------
 * Render all registered Routes here
 * Any registered Routes format should be rendered
 * before any routes can be executed.
 * -----------------------------------------------------
 */
(new FileLoader())
	->safeLoad(__DIR__ . '/web.php')
	->safeLoad(__DIR__ . '/api.php')
	->safeLoad(__DIR__ . '/forms.php');

Render::FormsRoute();
Render::ApiRoute();
Render::WebRoute();
