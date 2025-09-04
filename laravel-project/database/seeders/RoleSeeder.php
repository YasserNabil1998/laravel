<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon; // not used, but acceptable if needed later

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->updateOrInsert(
            ['name' => 'admin'],
            [
                'display_name' => 'Administrator',
                'permissions' => null,
                'is_active' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        DB::table('roles')->updateOrInsert(
            ['name' => 'student'],
            [
                'display_name' => 'Student',
                'permissions' => null,
                'is_active' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
