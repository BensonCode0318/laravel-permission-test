<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

use App\Exceptions\AuthException;

class AuthUserPermission extends BaseMiddleware
{
    protected $exception;
    public function __construct(
        AuthException $exception
    ) {
        $this->exception = $exception;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $routeName         = $request->route()->getName();
        $userPermissionAry = auth('api')->user()
            ->roles
            ->pluck('permissions')
            ->collapse()
            ->toArray();
        
        !isset($userPermissionAry[$routeName]) && $this->exception->error(904);

        return $next($request);
    }
}
