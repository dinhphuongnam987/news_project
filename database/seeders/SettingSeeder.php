<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->delete();

        DB::table('setting')->insert([
            [
                'key_value' => 'general-setting',
            ],
            [
                'key_value' => 'email-setting',
            ],
            [
                'key_value' => 'social-setting',
            ]
        ]);
    }
}
