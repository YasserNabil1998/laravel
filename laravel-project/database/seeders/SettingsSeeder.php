<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'app.name', 'value' => 'Exam System', 'type' => 'string', 'group' => 'general'],
            ['key' => 'app.locale', 'value' => 'ar', 'type' => 'string', 'group' => 'general'],
            ['key' => 'auth.allow_registration', 'value' => 'true', 'type' => 'boolean', 'group' => 'auth'],
            ['key' => 'exam.max_duration_minutes', 'value' => '180', 'type' => 'integer', 'group' => 'exam'],
            ['key' => 'billing.currency', 'value' => 'USD', 'type' => 'string', 'group' => 'billing'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                    'is_public' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
