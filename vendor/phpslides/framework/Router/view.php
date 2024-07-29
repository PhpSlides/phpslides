<?php declare(strict_types=1);

namespace PhpSlides\Router;

/**
 *   --------------------------------------------------------------
 *
 *   Router View
 *
 *   Which control the public URL and validating.
 *   This class is used in rendering views and parsing public URL in views.
 *
 *   --------------------------------------------------------------
 */
final class view extends Controller
{
	/**
	 *   --------------------------------------------------------------
	 *
	 * Render views and parse public URL in views
	 *
	 * @param string $view
	 * @return mixed return the file gotten from the view parameters
	 *
	 *   --------------------------------------------------------------
	 */
	final public static function render(string $view): mixed
	{
		try {
			// split :: into array and extract the folder and files
			$file = preg_replace('/(::)|::/', '/', $view);
			$file = strtolower(trim($file, '\/\/'));
			$view_path = '/views/' . $file;

			$file_uri = Route::$root_dir . $view_path;

			if (
				is_file($file_uri . '.view.php') &&
				!preg_match('/(..\/)/', $view)
			) {
				$file_type = Route::file_type($file_uri . '.view.php');
				header("Content-Type: $file_type");

				return self::view($file_uri . '.view.php');
			} elseif (is_file($file_uri) && !preg_match('/(..\/)/', $view)) {
				$file_type = Route::file_type($file_uri);
				header("Content-Type: $file_type");

				return self::slides_include($file_uri);
			} else {
				throw new Exception("No view file path found called `$view`");
			}
		} catch (Exception $e) {
			exit($e->getMessage());
		}
	}
}
