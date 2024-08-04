<?php

use PhpSlides\Foundation\Application;

include dirname(__DIR__) . '/../vendor/autoload.php';

Application::configure(basePath: dirname(dirname(__DIR__)))
	->routing(
		api: __DIR__ . '/../routes/api.php',
		web: __DIR__ . '/../routes/web.php'
	)
	->create();
