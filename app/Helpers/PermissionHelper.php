<?php

namespace App\Helpers;

class PermissionHelper
{

    public static function checkUserPermission($permissionName,$user): void
    {
        if ( auth()->user()->can($permissionName) ) {
            abort(403);
        }
    }

    public static function convertRouteNameToPermissionName($routeName = null): string|bool
    {
        if (is_null($routeName)) {
            $routeName = request()->route()->getName();
        }

        $routeName = str($routeName);

        $permissionName = $routeName;

        if (!$permissionName->startsWith('admin.')) {
            return false;
        }

        // allowed permissions read, create, update, delete
        if ($permissionName->endsWith('.index')) {
            $permissionName = $permissionName->replace('.index', '.read');
        }

        if ($permissionName->endsWith('.create')) {
            $permissionName = $permissionName->replace('.create', '.create');
        }

        if ($permissionName->endsWith('.edit')) {
            $permissionName = $permissionName->replace('.edit', '.update');
        }

        if ($permissionName->endsWith('.show')) {
            $permissionName = $permissionName->replace('.show', '.read');
        }

        if ($permissionName->endsWith('.update')) {
            $permissionName = $permissionName->replace('.update', '.update');
        }

        if ($permissionName->endsWith('.destroy')) {
            $permissionName = $permissionName->replace('.destroy', '.delete');
        }

        if ($permissionName === $routeName) {
            return false;
        }

        return $permissionName->replace('.','_');

    }
}
