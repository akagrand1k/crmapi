<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(AppsPermsRoles::seeds('Roles'));/*
        DB::table('roles')->insert([
            [
                'default' => TRUE,
                'slug' => 'student',
                'name' => 'Студент',
                'description' => '',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'default' => TRUE,
                'slug' => 'teacher',
                'name' => 'Учитель',
                'description' => '',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'default' => TRUE,
                'slug' => 'admin',
                'name' => 'Администратор',
                'description' => 'Методист, Завуч',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'default' => TRUE,
                'slug' => 'owner',
                'name' => 'Владелец',
                'description' => '',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'default' => TRUE,
                'slug' => 'saleman',
                'name' => 'Менеджер по продажам',
                'description' => '',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'default' => TRUE,
                'slug' => 'superadmin',
                'name' => 'СуперМен',
                'description' => 'Разработчики',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);*/
    }
}
