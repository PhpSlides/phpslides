# Changes Logs

## [v1.2.3] Pre-release

- [v1.x]

## [v1.2.2](https://github.com/PhpSlides/phpslides/releases/tag/v1.2.2)

- [v1.x] __(Tue, July 02 2024)__
- [v1.x] Added `asset()` function in `Functions.php` file, and can distinguish to start path from relative path or root path
- [v1.x] `RouteController.php` in `slides_include()` function.
- [v1.x] Removed `::view` and `::root` string and it's functions.
- [v1.x] Added `__ROOT__` constant
- [v1.x] Updated slides_include file to auto clone a file to a generated file.
- [v1.x] Can now use normal relative path in `slides_include()` function.
- [v1.x] Improved in Route Map function, can now use `name()` method in any position.
- [v1.x] Updated Request URL to match both uppercase and lowercase
- [v1.x] Renamed `/routes/route.php` to `/routes/web.php`
- [v1.x] Added named route function to normal route method `POST`, `GET`, `PATCH`, `PUT`, `DELETE`, `VIEW`.
- [v1.x] __(Tue, July 09 2024)__
- [v1.x] Change all file names to CamelCase
- [v1.x] Added configuration for Console
- [v1.x] Added Console template for Controller, ApiController, Middleware.
- [v1.x] __(Thursday, July 11 2024)__
- [v1.x] Added Authorization method for getting Basic and Bearer token.
- [v1.x] __(Saturday, July 13 2024)__
- [v1.x] Completed API Controller function.
- [v1.x] Completed middleware function.
- [v1.x] __(Tuesday, July 16 2024)__
- [v1.x] Worked on controller and Middleware
- [v1.x] Added mapping method in Api controller
- [v1.x] Api controller now accepts naming route in mapping method.
- [v1.x] __(Friday, July 19 2024)__
- [v1.x] Make API `define()` method now working with `route()` method
- [v1.x] Work on `route()` so when using `define()` with `route()` they can pass second parameter in `route()` as controller method for the defined route
- [v1.x] Added more methods to `Request` class
- [v1.x] Added documentation to each methods in Request class and interface with Api class and interface
- [v1.x] Added more version methods API class manually.
- [v1.x] Added more version methods to API interface manually.
