<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConnectModesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 		DB::table('connect_modes')->insert([
            [
                'caption' => 'Занятие по расписанию',
                'description' => '',
            ],[
                'caption' => 'Преподаватель',
                'description' => '',
            ],[
                'caption' => 'Пробный урок',
                'description' => '',
            ],[
                'caption' => 'Отработка',
                'description' => '',
            ]
        ]);
    }
}
