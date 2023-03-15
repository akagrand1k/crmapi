<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perms')->insert(AppsPermsRoles::seeds('Perms'));/*
        DB::table('perms')->insert([[
            // id = 1
            'app_id' => 1, // Pages
            'slug' => '*',
            'name' => 'Полный доступ',
        ],[
            // id = 2
            'app_id' => 2, // Users
            'slug' => 'read',
            'name' => 'Только чтение',
        ],[
            // id = 3
            'app_id' => 2, // Users
            'slug' => 'update',
            'name' => 'Редактирование',
        ],[
            // id = 4
            'app_id' => 3, // About
            'slug' => '*',
            'name' => 'Полный доступ',
        ],[
            // id = 5
            'app_id' => 4, // Test
            'slug' => '*',
            'name' => 'Полный доступ',
        ],[
            // id = 6
            'app_id' => 5, // Roles
            'slug' => '*',
            'name' => 'Полный доступ',
        ],[
            // id = 7
            'app_id' => 6, // Company
            'slug' => '*',
            'name' => 'Полный доступ',
        ],[
            // id = 8
            'app_id' => 7, // Сourse
            'slug' => '*',
            'name' => 'Полный доступ',
        ],[
            // id = 9
            'app_id' => 8, // Teachers
            'slug' => '*',
            'name' => 'Полный доступ',
        ],[
            // id = 10
            'app_id' => 9, // Gangs
            'slug' => '*',
            'name' => 'Полный доступ',
        ]]);*/
    }
}
