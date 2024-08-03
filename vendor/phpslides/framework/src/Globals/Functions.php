<?php

use PhpSlides\Exception;
use PhpSlides\Loader\ViewLoader;
use PhpSlides\Foundation\Application;

define('__ROOT__', Application::$basePath);

const GET = 'GET';
const PUT = 'PUT';
const POST = 'POST';
const PATCH = 'PATCH';
const DELETE = 'DELETE';
const RELATIVE_PATH = 'path';
const ROOT_RELATIVE_PATH = 'root_path';

/**
 *    -----------------------------------------------------------
 *   |
 *   @param mixed $filename The file which to gets the contents
 *   @return mixed The executed included file received
 *   |
 *    -----------------------------------------------------------
 */
function slides_include ($filename)
{
	$loaded = (new ViewLoader())->load($filename);
	return $loaded->getLoad();
}

$routes = [];

/**
 * Give route a name and value
 *
 * @param string $name Name of the given route to be specified
 * @param string|array $value Named route value
 * @return void
 */
function add_route_name (string $name, string|array $value): void
{
	global $routes;
	$routes[$name] = $value;
}

/**
 * Get Route results from named route
 *
 * @param string|null $name The name of the route to return
 * @param array|null $param If the route has parameter, give the parameter a value
 *
 * @return array|object|string returns the route value
 */
function route (
 string|null $name = null,
 array|null $param = null,
): array|object|string {
	global $routes;

	if ($name === null)
	{
		$route_class = new stdClass();

		foreach ($routes as $key => $value)
		{
			if (preg_match_all('/(?<={).+?(?=})/', $value))
			{
				$route_class->$key = function (string ...$args) use ($routes, $value, $key)
				{
					$route = '';

					if (count($args) === 0)
					{
						$route = $routes[$key];
					}
					else
					{
						for ($i = 0; $i < count($args); $i++)
						{
							if ($i === 0)
							{
								$route = preg_replace(
								 '/\{[^}]+\}/',
								 $args[$i],
								 $value,
								 1
								);
							}
							else
							{
								$route = preg_replace(
								 '/\{[^}]+\}/',
								 $args[$i],
								 $route,
								 1
								);
							}
						}
					}
					return $route;
				};
			}
			else
			{
				$route_class->$key = $value;
			}
		}

		return $route_class;
	}
	else
	{
		if (!array_key_exists($name, $routes))
		{
			return '';
		}
		else
		{
			if ($param === null)
			{
				return $routes[$name];
			}
			else
			{
				$route = '';

				for ($i = 0; $i < count($param); $i++)
				{
					if ($i === 0)
					{
						$route = preg_replace(
						 '/\{[^}]+\}/',
						 $param[$i],
						 $routes[$name],
						 1
						);
					}
					else
					{
						$route = preg_replace('/\{[^}]+\}/', $param[$i], $route, 1);
					}
				}
				return $route;
			}
		}
	}
}

/**
 * Getting public files
 *
 * @param string $filename The name of the file to get from public directory
 * @param string $path_type Path to start location which uses either `RELATIVE_PATH`
 * for path `../` OR `ROOT_RELATIVE_PATH` for root `/`
 */
function asset (string $filename, $path_type = RELATIVE_PATH): string
{
	$filename = preg_replace('/(::)|::/', '/', $filename);
	$filename = strtolower(trim($filename, '\/\/'));

	if (php_sapi_name() == 'cli-server')
	{
		$root_path = '/';
	}
	else
	{
		$find = '/src/bootstrap/app.php';
		$self = $_SERVER['PHP_SELF'];

		$root_path = substr_replace(
		 $self,
		 '/',
		 strrpos($self, $find),
		 strlen($find)
		);
	}

	$path = './';
	if (!empty(Application::$request_uri))
	{
		$root_pathExp = explode('/', trim($root_path, '/'));
		$reqUri = explode('/', trim(Application::$request_uri, '/'));

		for ($i = 0; $i < count($reqUri) - count($root_pathExp); $i++)
		{
			$path .= '../';
		}
	}

	switch ($path_type)
	{
		case RELATIVE_PATH:
			return $path . $filename;
		case ROOT_RELATIVE_PATH:
			return $root_path . $filename;
		default:
			return $filename;
	}
}


function ExceptionHandler ($exception)
{
	// Check if the exception is a CustomException to use its specific methods
	if ($exception instanceof Exception)
	{
		$file = $exception->getFilteredFile();
		$line = $exception->getFilteredLine();
		$codeSnippet = $exception->getCodeSnippet();
		$detailedMessage = $exception->getDetailedMessage();
	}
	else
	{
		// For base Exception, use default methods
		$file = $exception->getFile();
		$line = $exception->getLine();
		$detailedMessage = sprintf(
		  "Error: %s in %s on line %d",
		  $exception->getMessage(),
		  $file,
		  $line
		);

		// Get code snippet manually
// $codeSnippet = $exceptiongetCodeSnippet($file, $line);
	}

	// Log the detailed error message
// error_log($detailedMessage);

	// Display custom HTML error message
	echo "<h1>An error occurred</h1>";
	echo "<p>We are sorry, but something went wrong. Please try again later.</p>";

	// // Display detailed error information
	echo "<h2>Error Details</h2>";
	echo "<p><strong>Message:</strong> " . htmlspecialchars($detailedMessage) . "</p>";
	echo "<p><strong>File:</strong> " . htmlspecialchars($file) . "</p>";
	echo "<p><strong>Line:</strong> " . htmlspecialchars($line) . "</p>";

	// // Display code snippet
	echo "<h2>Code Snippet</h2>";
	echo "<pre style='background-color: #f8f8f8; padding: 10px; border: 1px solid #ccc;'>";

	foreach ($codeSnippet ?? [] as $lineNumber => $lineContent)
	{
		$lineContent = htmlspecialchars($lineContent);
		if ($lineNumber + 1 == $line)
		{
			echo "<span style='background-color: #ffdddd; color: #a00;'>" . ($lineNumber + 1) . ": " . $lineContent . "</span>";
		}
		else
		{
			echo ($lineNumber + 1) . ": " . $lineContent;
		}
	}
	echo "</pre>";
}

set_exception_handler('ExceptionHandler');