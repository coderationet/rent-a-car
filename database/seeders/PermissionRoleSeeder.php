<?php

namespace Database\Seeders;

use App\Helpers\PermissionHelper;
use App\Models\Authorizon\PermissionDescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // all route names for permissions
        $role = Role::create(['name' => 'admin', 'guard_name' => 'web']);

        $permissions = Route::getRoutes();

        foreach ($permissions as $permission) {

            $routeName = $permission->getName();

            if (is_null($routeName)) {
                continue;
            }

            $permissionName = PermissionHelper::convertRouteNameToPermissionName($routeName);

            if (!$permissionName){
                continue;
            }
            if (Permission::where('name', $permissionName)->exists()) {
                continue;
            }

            $permission = Permission::create(['name' => $permissionName, 'guard_name' => 'web']);

            PermissionDescription::create([
                'permission_id' => $permission->id,
                'name' => $permissionName,
                'description' => $permissionName,
            ]);

            $role->givePermissionTo($permission);

        }
    }
}
