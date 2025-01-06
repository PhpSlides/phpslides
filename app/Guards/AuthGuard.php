<?php

namespace App\Guards;

use PhpSlides\Core\Web\JWT;
use PhpSlides\Core\Http\Auth\AuthGuard as BaseAuthGuard;

final class AuthGuard extends BaseAuthGuard
{
	/**
	 * Implement the authorization logic.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		$token = self::$request->auth()->bearer;

		if ($token && JWT::verify($token)) {
			return true;
		}

		echo 'Invalid Token';
		return false;
	}
}
