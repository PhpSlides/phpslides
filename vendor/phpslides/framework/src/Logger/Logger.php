<?php declare(strict_types=1);

namespace PhpSlides\Logger;

use DateTime;
use PhpSlides\Route;
use PhpSlides\Foundation\Application;

trait Logger
{
	public static function log(): void
	{
		$log_path = Application::$basePath . 'requests.log';

		// set current date format
		$date = new DateTime('now');
		$date = date_format($date, 'D, d-m-Y H:i:s');

		// get request method type
		$method = $_SERVER['REQUEST_METHOD'];

		// get request url
		$uri = '/' . urldecode($_SERVER['REQUEST_URI']);

		// get status response code for each request
		$http_code = http_response_code();

		// protocol code for request header
		$http_protocol = $_SERVER['SERVER_PROTOCOL'];

		// all content messages to log
		$content = "[$date]  $method  $http_protocol  $http_code  $uri\n";

		if (Route::$log === true) {
			$log = fopen($log_path, 'a');
			fwrite($log, $content);
			fclose($log);
		}
	}
}
