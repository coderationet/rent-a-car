<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'example@example.com',
            'password' => bcrypt('password'),
        ]);

        # create role admin
        $role = Role::create(['name' => 'admin']);

        # assign role admin to user
        $admin->assignRole($role);
    }
}
