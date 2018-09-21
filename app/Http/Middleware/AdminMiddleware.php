<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->hasAnyPermission('進入後台')) {
            abort(403);
        }

        if (starts_with($request->path(), 'admin/')) {
            $resource = explode('/',$request->path())[1];
            $adminOnlyResources = ['user', 'role', 'permission'];
            if (in_array($resource, $adminOnlyResources) && !$request->user()->hasAnyRole('管理員')) {
                abort(403);
            }
        }

        return $next($request);
    }
}
