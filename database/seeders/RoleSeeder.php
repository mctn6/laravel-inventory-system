<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Create permissions if they don't exist
        $manageUsersPermission = Permission::firstOrCreate(['name' => 'manage users', 'guard_name' => 'web']);
        $manageSettingsPermission = Permission::firstOrCreate(['name' => 'manage settings', 'guard_name' => 'web']);

        // Assign permissions to roles
        $adminRole->givePermissionTo([$manageUsersPermission, $manageSettingsPermission]);
        $userRole->givePermissionTo([]); // No permissions for user role
    }
}
