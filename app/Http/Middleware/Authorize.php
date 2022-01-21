<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
		try {
			//Access token from the request        
			$token = JWTAuth::parseToken();
			//Try authenticating user       
			$user = $token->authenticate();

		} catch (TokenExpiredException $e) {
			//Thrown if token has expired        
			return $this->unauthorized('Your token has expired. Please, login again.', 401);
		} catch (TokenInvalidException $e) {
			//Thrown if token invalid
			return $this->unauthorized('Your token is invalid. Please, login again.', 401);
		}catch (JWTException $e) {
			//Thrown if token was not found in the request.
			return $this->unauthorized('Please, attach a Bearer Token to your request', 401);
		}

		//If user was authenticated successfully and user is in one of the acceptable roles, send to next request.
		if ($user && in_array($user->role_id, $roles)) {
			return $next($request);
		}

		return $this->unauthorized('Unauthorized access.', 403);
	}
	
	private function unauthorized($message, $code){
		return response()->json([
			'error' => [
				'status' => $code,
				'message' => $message,
			]
		], $code);
	}
}
