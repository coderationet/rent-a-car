<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
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
        $role = Role::create(['name' => 'admin', 'guard_name' => 'web']);

        $permissions = PermissionEnum::cases();

        foreach ($permissions as $permission) {
            $permission = Permission::create(['name' => $permission, 'guard_name' => 'web']);
            $role->givePermissionTo($permission);
        }
    }
}
