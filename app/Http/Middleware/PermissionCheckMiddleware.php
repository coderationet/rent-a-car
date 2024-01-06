<?php

namespace App\Http\Middleware;

use App\Helpers\PermissionHelper;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();

        $permissionName = PermissionHelper::convertRouteNameToPermissionName($routeName);

        $permission = Permission::where('name', $permissionName);

        if ($request->routeIs('admin.*')
            && $permissionName
            && $permission->exists()
            && auth()->user()
            && auth()->user()->cannot($request->route()->getName())
        ) {
            abort(403);
        }

        return $next($request);
    }
}
