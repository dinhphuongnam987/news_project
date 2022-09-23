<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->delete();

        DB::table('menu')->insert([
            [
                'name'      => 'Trang chủ',
                'link'      => '/',
                'status'    => 'active',
                'ordering'  => 1,
                'type_menu' => 'link',
                'type_open' => 'current',
                'created' => date('Y-m-d'),
                'created_by' => 'admin',
                'modified'  => date('Y-m-d'),
                'modified_by' => 'admin'
            ],
            [
                'name'      => 'Giới thiệu',
                'link'      => '/about',
                'status'    => 'active',
                'ordering'  => 2,
                'type_menu' => 'link',
                'type_open' => 'new_window',
                'created' => date('Y-m-d'),
                'created_by' => 'admin',
                'modified'  => date('Y-m-d'),
                'modified_by' => 'admin'
            ],
            [
                'name'      => 'Bài viết',
                'link'      => '#',
                'status'    => 'active',
                'ordering'  => 3,
                'type_menu' => 'category_article',
                'type_open' => 'new_tab',
                'created' => date('Y-m-d'),
                'created_by' => 'admin',
                'modified'  => date('Y-m-d'),
                'modified_by' => 'admin'
            ]
        ]);
    }
}
