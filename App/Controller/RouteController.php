<?php

namespace PhpSlides\Controller;

use DateTime;
use Exception;
use PhpSlides\Route;


class RouteController
{

    /**
     *  ----------------------------------------------------------------------------------
     *  |
     *  |   `config_file` allows you to write configurations in `phpslides.config.json` file.
     * 
     *      @return array|bool an `array` data retrieve from json data gotten from the config files
     *  |
     *  ----------------------------------------------------------------------------------
     */
    protected static function config_file(): array|bool
    {
        $file_path = dirname(__DIR__) . '../../' . '/phpslides.config.json';

        // checks if the config file exist in project root directory
        if (is_file($file_path))
        {
            // get json files and convert it to an array
            $config_file = file_get_contents($file_path);
            $config_file = json_decode($config_file, true);

            return $config_file;
        }
        else
        {
            throw new Exception('URL request failed. Configuration file for PhpSlides is not found in the root of your project');
        }
    }



    /**
     *  ==============================
     *  |   Don't use this function!!!
     *  |   --------------------
     *  ==============================
     */
    protected static function routing(array|string $route, $callback, string $method = "*")
    {

        $uri = [];
        $str_route = '';
        $reqUri = preg_replace("/(^\/)|(\/$)/", "", $_REQUEST["uri"]);

        if (is_array($route))
        {
            for ($i = 0; $i < count($route); $i++)
            {
                $each_route = preg_replace("/(^\/)|(\/)/", "", $route[$i]);
                array_push($uri, $each_route);
            }
        }
        else
        {
            $str_route = preg_replace("/(^\/)|(\/)/", "", $route);
        }

        if (in_array($reqUri, $uri) || $reqUri === $str_route)
        {
            // checks if the requested method is of the given route
            if (strtoupper($_SERVER['REQUEST_METHOD']) !== strtoupper($method) && $method !== '*')
            {
                http_response_code(405);
                self::log();
                exit('Method Not Allowed');
            }

            $charset = self::config_file()['charset'];
            header("Content-type: */*, charset=$charset");
            http_response_code(200);

            return $callback;
        }
        else
        {
            return false;
        }
    }



    /**
     *  ---------------------------------
     *  |
     *  |   log all request to `.log` file
     *  |
     *  ---------------------------------
     */
    protected static function log()
    {
        $log_path = dirname(__DIR__) . '../../' . '/.log';

        // set current date format
        $date = new DateTime('now');
        $date = date_format($date, 'D, d-m-Y H:i:s');

        // get request method type
        $method = $_SERVER["REQUEST_METHOD"];

        // get request url
        $uri = '/' . $_REQUEST["uri"];

        // get status response code for each request
        $http_code = http_response_code();

        //  protocol code for request header
        $http_protocol = $_SERVER["SERVER_PROTOCOL"];

        // all content messages to log 
        $content = "$method\t\t\t $http_protocol\t\t\t $http_code\t\t\t $uri\t\t\t $date\n\n";

        echo Route::$log;
        if (Route::$log === true)
        {
            $log = fopen($log_path, 'a');
            fwrite($log, $content);
            fclose($log);
        }
    }


    /**
     *  Don't use this function!!!
     * 
     *  @param object|string $class In implementing class constructor from Controller
     *  @param string $method In accessing methods to render to routes
     *  @return mixed From class methods and __invoke function
     */
    protected static function controller(object|string $class, string $method, array|null $param = null)
    {
        return ClassController::__class($class, $method, $param);
    }



    /**
     *  ==============================
     *  |   Don't use this function!!!
     *  |   --------------------
     *  ==============================
     */
    protected static function class_info(array $class_info, array|null $param)
    {
        $method = $class_info['method'];
        $class_name = $class_info['class_name'];
        $class_methods = $class_info['class_methods'];

        $class = new $class_name();

        for ($i = 0; $i < count($class_methods); $i++)
        {
            if ((empty($method) || $method === '__invoke'))
            {
                return ($param != null) ? $class(...$param) : $class();
            }
            else if ($method === $class_methods[$i])
            {
                return ($param != null) ? $class->$method(...$param) : $class->$method();
            }
            else if (count($class_methods) - 1 === $i && $method !== $class_methods)
            {
                throw new Exception("No Controller method found as $method. Try using __invoke method.", 1);
            }
        }
    }

}