<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class MoveTaskPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Permission
        $permission = Permission::firstOrCreate([
            'name' => 'tasks.move',
        ]);

        // Role
        $role = Role::firstOrCreate([
            'name' => 'admin',
        ]);

        $role->givePermissionTo($permission);

        // User
        $user = User::where('email', 'test@example.com')->first();

            $user->assignRole($role);
    }
}

