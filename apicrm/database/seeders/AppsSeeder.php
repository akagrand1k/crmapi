<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;

class AppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$apr = new AppsPermsRoles();
        DB::table('apps')->insert(AppsPermsRoles::seeds('Apps'));/*
        DB::table('apps')->insert([[
            // id = 1
            'slug' => 'Pages',
            'name' => 'Страницы',
            'config' => json_encode([
                "path" => "/pages",
                "name" => "Pages",
                "component" => "Pages",
                "meta" => ["icon" => "link", "title" => "Страницы"]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            // id = 2
            'slug' => 'Users',
            'name' => 'Аккаунты',
            'config' => json_encode([
                "path" => "/users",
                "name" => "Users",
                "component" => "Users",
                "meta" => ["icon" => "manage_accounts", "title" => "Аккаунты",]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            // id = 3
            'slug' => 'About',
            'name' => 'О проекте',
            'config' => json_encode([
                "path" => "/about",
                "name" => "About",
                "component" => "About",
                "meta" => ["icon" => "description", "title" => "О проекте"]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            // id = 4
            'slug' => 'Test',
            'name' => 'Тестовый компонент',
            'config' => json_encode([
                "path" => "/test",
                "name" => "Test",
                "component" => "Test",
                "meta" => ["icon" => "bug_report", "title" => "Тестовый компонент"]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            // id = 5
            'slug' => 'Roles',
            'name' => 'Роли',
            'config' => json_encode([
                "path" => "/roles",
                "name" => "Roles",
                "component" => "Roles",
                "meta" => ["icon" => "theater_comedy", "title" => "Роли",]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            // id = 6
            'slug' => 'Company',
            'name' => 'Филиалы',
            'config' => json_encode([
                "path" => "/company",
                "name" => "Company",
                "component" => "Company",
                "meta" => ["icon" => "apartment", "title" => "Филиалы",]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            // id = 7
            'slug' => 'Сourse',
            'name' => 'Курсы',
            'config' => json_encode([
                "path" => "/course",
                "name" => "Course",
                "component" => "Course",
                "meta" => ["icon" => "menu_book", "title" => "Курсы",]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            // id = 8
            'slug' => 'Teachers',
            'name' => 'Преподы',
            'config' => json_encode([
                "path" => "/teachers",
                "name" => "Teachers",
                "component" => "Teachers",
                "meta" => ["icon" => "school", "title" => "Преподы",]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            // id = 9
            'slug' => 'Gangs',
            'name' => 'Группы',
            'config' => json_encode([
                "path" => "/gangs",
                "name" => "Gangs",
                "component" => "Gangs",
                "meta" => ["icon" => "groups", "title" => "Группы",]
            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]]);*/

        /* $perm_id = DB::table('perms')->insertGetId([
            'app_id' => 3,
            'slug' => '*',
            'name' => 'Полный доступ',
        ]); */
    }
}
