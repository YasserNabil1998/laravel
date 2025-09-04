<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'manage_users', 'display_name' => 'Manage Users', 'group' => 'users'],
            ['name' => 'manage_roles', 'display_name' => 'Manage Roles', 'group' => 'users'],
            ['name' => 'manage_permissions', 'display_name' => 'Manage Permissions', 'group' => 'users'],
            ['name' => 'manage_exams', 'display_name' => 'Manage Exams', 'group' => 'exams'],
            ['name' => 'view_results', 'display_name' => 'View Results', 'group' => 'results'],
            ['name' => 'take_exams', 'display_name' => 'Take Exams', 'group' => 'exams'],
            ['name' => 'manage_payments', 'display_name' => 'Manage Payments', 'group' => 'billing'],
            ['name' => 'view_dashboard', 'display_name' => 'View Dashboard', 'group' => 'dashboard'],
            ['name' => 'manage_settings', 'display_name' => 'Manage Settings', 'group' => 'settings'],
        ];

        foreach ($permissions as $perm) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $perm['name']],
                [
                    'display_name' => $perm['display_name'],
                    'description' => null,
                    'group' => $perm['group'],
                    'is_active' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
