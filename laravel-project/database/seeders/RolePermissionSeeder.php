<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch role IDs
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        $studentRoleId = DB::table('roles')->where('name', 'student')->value('id');

        if (!$adminRoleId || !$studentRoleId) {
            return; // roles must be seeded first
        }

        $allPermissionIds = DB::table('permissions')->pluck('id')->all();
        $takeExamId = DB::table('permissions')->where('name', 'take_exams')->value('id');
        $viewDashboardId = DB::table('permissions')->where('name', 'view_dashboard')->value('id');

        // Admin gets all permissions
        foreach ($allPermissionIds as $pid) {
            DB::table('role_permissions')->updateOrInsert(
                ['role_id' => $adminRoleId, 'permission_id' => $pid],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        // Student gets limited permissions
        foreach (array_filter([$takeExamId, $viewDashboardId]) as $pid) {
            DB::table('role_permissions')->updateOrInsert(
                ['role_id' => $studentRoleId, 'permission_id' => $pid],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
