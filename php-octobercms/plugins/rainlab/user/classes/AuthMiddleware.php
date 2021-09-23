<?php namespace RainLab\User\Classes;

use Auth;
use Closure;
use Response;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return Response::make('Forbidden', 403);
        }

        return $next($request);
    }
}
