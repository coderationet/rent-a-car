<?php

namespace App\Helpers;

class PermissionHelper
{

    public static function abortIfUserDoesNotHavePermission($permissionName,$user = null): void
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        if ( $user->cannot($permissionName->value) ) {
            abort(403);
        }
    }
    public static function checkIfUserHasPermission($permissionName,$user = null): bool
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        return $user->can($permissionName->value);
    }
    /**
     * Convert route name to permission name
     *
     * @param $routeName
     * @return string|bool
     */
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

        if ($permissionName->endsWith('.edit')) {
            $permissionName = $permissionName->replace('.edit', '.read');
        }

        if ($permissionName->endsWith('.show')) {
            $permissionName = $permissionName->replace('.show', '.read');
        }

        if ($permissionName->endsWith('.destroy')) {
            $permissionName = $permissionName->replace('.destroy', '.delete');
        }

        if($permissionName->endsWith('.store')){
            $permissionName = $permissionName->replace('.store', '.create');
        }

        if (!$permissionName->endsWith('.read')
            && !$permissionName->endsWith('.create')
            && !$permissionName->endsWith('.update')
            && !$permissionName->endsWith('.delete')
        ) {
            return false;
        }

        $permissionName = $permissionName->replace('admin.','');

        $permissionName = $permissionName->replace('-','_');

        return $permissionName->replace('.','_');

    }

    public static function convertPermissionNameToPermissionDescriptionName($permissionName): string
    {
        $permissionName = str($permissionName);

        $permissionDescriptionName = $permissionName;

        if ($permissionDescriptionName->endsWith('.read')) {
            $permissionDescriptionName = $permissionDescriptionName->replace('.read', ' read');
        }

        if ($permissionDescriptionName->endsWith('.create')) {
            $permissionDescriptionName = $permissionDescriptionName->replace('.create', ' create');
        }

        if ($permissionDescriptionName->endsWith('.update')) {
            $permissionDescriptionName = $permissionDescriptionName->replace('.update', ' update');
        }

        if ($permissionDescriptionName->endsWith('.delete')) {
            $permissionDescriptionName = $permissionDescriptionName->replace('.delete', ' delete');
        }

        $permissionDescriptionName = $permissionDescriptionName->replace('admin.','');

        $permissionDescriptionName = $permissionDescriptionName->replace('_',' ');

        $permissionDescriptionName = $permissionDescriptionName->ucfirst();

        return $permissionDescriptionName->replace('.',' ')->ucfirst();
    }
}
