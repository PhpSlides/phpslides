<?php declare(strict_types=1);

namespace App\Middleware;

use Closure;
use PhpSlides\Web\JWT;
use PhpSlides\Http\Request;
use PhpSlides\Interface\MiddlewareInterface;

final class AuthMiddleware implements MiddlewareInterface
{
	public function handle(Request $request, Closure $next)
	{
		$token = $request->auth->bearer;

		if ($token && JWT::verify($token)) {
			return $next($request);
		}
		return 'Invalid Token';
	}
}
